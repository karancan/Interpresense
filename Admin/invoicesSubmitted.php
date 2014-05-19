<?php

namespace Interpresense\Admin;

use Interpresense\Includes\AntiXss;

/**
 * Configuration file, database object, settings and Anti XSS
 */
require '../includes/php/config.php';
$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);
$antiXSS = new AntiXss();

/**
 * Session
 */
session_start();
if (!isset($_SESSION['admin']['user_id'])) {
    header('location: https://' . URL_ADMIN . '/index.php?next=' . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}

/**
 * Models
 */
$invoicesModel = new \Interpresense\ServiceProvider\Invoice($dbo);
$invoicesItemsModel = new \Interpresense\ServiceProvider\InvoiceItems($dbo);
$invoicesFilesModel = new \Interpresense\ServiceProvider\InvoiceFiles($dbo);
$invoicesNotesModel = new InvoiceNotes($dbo);

/**
 * Localization
 */
if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = $settings['institution_default_lang'];
}
\Locale::setDefault($_SESSION['lang']);

// Translation
$translate = new \JsonI18n\Translate(\Locale::getDefault());

// Date formatting
$dateFmt = new \JsonI18n\DateFormat(\Locale::getDefault());
$dateFmt->addResource(FS_L10N . '/dateFormatters.json');

// Number formatting
$numFmt = new \JsonI18n\NumberFormat(\Locale::getDefault());
$numFmt->addResource(FS_L10N . '/numberFormatters.json');

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    
    $unreadInvoiceCount = $invoicesModel->fetchUnreadFinalizedInvoiceCount();
    
    if (!empty($_GET['start'])) {
        try {
            $filter_start_date = new \DateTime($_GET['start']);
        } catch (\Exception $e) {
            $filter_start_date = new \DateTime("-{$settings['admin_default_date_filter_range_days']} days");
        }
    } else {
        $filter_start_date = new \DateTime("-{$settings['admin_default_date_filter_range_days']} days");
    }
    
    if (!empty($_GET['end'])) {
        try {
            $filter_end_date = new \DateTime($_GET['end']);
        } catch (\Exception $e) {
            $filter_end_date = new \DateTime("+{$settings['admin_default_date_filter_range_days']} days");
        }
    } else {
        $filter_end_date = new \DateTime("+{$settings['admin_default_date_filter_range_days']} days");
    }
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'final', ($_GET['approved_only'] === '1' ? true : false));
    
    if (!empty($invoices)){
        foreach ($invoices as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    $translate->addResource('l10n/invoicesSubmitted.json');
    $viewFile = "views/invoicesSubmitted.php";
    
} else if ($_GET['page'] === "fetch-invoice-items") {
    
    //Was this invoice viewed previously?
    $invoiceViewed = $invoicesModel->fetchInvoiceViewedDetails($_POST['invoice_id']);
    if (!empty($invoiceViewed)) {
        $invoiceViewed[0]['admin_last_viewed_on'] = $dateFmt->format($invoiceViewed[0]['admin_last_viewed_on'], 'date_time');
    }
    
    //Mark the invoice as viewed
    $invoicesModel->markInvoiceViewed($_POST['invoice_id']);
    
    //Invoice items
    $items = $invoicesItemsModel->fetchItems($_POST['invoice_id']);
    
    $grandTotal = 0;
    
    foreach ($items as &$i){
        $i['inserted_on'] = $dateFmt->format($i['inserted_on'], 'date_time');
        $i['start_time'] = $dateFmt->format($i['start_time'], 'time');
        $i['end_time'] = $dateFmt->format($i['end_time'], 'time');
        
        $startTime = new \DateTime($i['start_time']);
        $startTime = $startTime->getTimestamp();
        $endTime = new \DateTime($i['end_time']);
        $endTime = $endTime->getTimestamp();
        $hours = ($endTime-$startTime) / 3600;
        $rate = $hours * $i['rate'];
        $i['item_total'] = number_format((float)$rate, 2);
        $grandTotal += $rate;
    }
    unset($i);
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('items' => $items, 'grand_total' => $grandTotal, 'viewed' => $invoiceViewed[0]));
    exit;
    
} else if ($_GET['page'] === "fetch-invoice-files") {
    
    $files = $invoicesFilesModel->fetchFiles($_POST['invoice_id']);
    foreach ($files as &$f){
        $f['inserted_on'] = $dateFmt->format($f['inserted_on'], 'date_time');
    }
    unset($f);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($files);
    exit;
    
} elseif ($_GET['page'] === "view-file") {
    
    $invoiceFile = $invoicesFilesModel->fetchFile($_GET['file_id']);
    if (!empty($invoiceFile)) {
        header("Content-Type: " . $invoiceFile[0]['file_type']);
        header("Content-Disposition:attachment; filename=" . str_replace(',', '', $invoiceFile[0]['file_name']) . "");
        header('Content-Length: ' . $invoiceFile[0]['file_size']);
        echo $invoiceFile[0]['file_content'];
        exit;
    } else {
        //No file found. An error page is shown
        $viewFile = '';
    }
    
} else if ($_GET['page'] === "fetch-invoice-notes") {

    $notes = $invoicesNotesModel->fetchNotes($_POST['invoice_id']);
    foreach ($notes as &$n){
        $n['inserted_on'] = $dateFmt->format($n['inserted_on'], 'date_time');
    }
    unset($n);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($notes);
    exit;
    
} elseif ($_GET['page'] === "add-note"){
    
    $invoicesNotesModel->addNote($_POST);
    header('Location: invoicesSubmitted.php?start=' . $_GET['start'] . '&end=' . $_GET['end'] . '&focus=' . $_POST['invoice_id']); //@todo: respect approved

} else if ($_GET['page'] === "mark-invoice-as-draft") {
    
    if (!empty($_GET['invoice_id'])) {
        $invoicesModel->markInvoiceAsDraft($_GET['invoice_id']);
        
        //@todo: create an invoice note stating that the invoice was changed to draft status
        //@todo: send email to service provider telling them the invoice was marked as a draft with the note attached
    
        header('Location: invoicesSubmitted.php?focus=' . $_GET['invoice_id']); //@todo: respect start, end, approved
        exit;
    } else {
        $viewFile = ''; //Show error page
    }

} else if ($_GET['page'] === "mark-invoice-as-approved") {
    
    if (!empty($_GET['invoice_id'])) {
        $invoicesModel->markInvoiceAsApproved($_GET['invoice_id']);
        
        //@todo: create an invoice note stating that the invoice was marked approved
        //@todo: send email to service provider telling them the invoice was approved
        
        header('Location: invoicesSubmitted.php?focus=' . $_GET['invoice_id'] . '&start=' . $_GET['start'] . '&end=' . $_GET['end'] . '&approved_only=' . $_GET['approved_only']);
        exit;
    } else {
        $viewFile = ''; //Show error page
    }
    
} else if ($_GET['page'] === "update-invoice-id-for-org") {
    
    $invoicesModel->updateOrgInvoiceId($_POST['invoice_id'], (empty($_POST['invoice_id_for_org']) ? null : $_POST['invoice_id_for_org']));
    
} else if ($_GET['page'] === "mark-invoice-as-unread") {

    $invoicesModel->markInvoiceAsUnread($_POST['invoice_id']);
    
} else if ($_GET['page'] === "export") {
    
    if (!empty($_GET['start'])) {
        try {
            $filter_start_date = new \DateTime($_GET['start']);
        } catch (\Exception $e) {
            $filter_start_date = new \DateTime("-{$settings['admin_default_date_filter_range_days']} days");
        }
    } else {
        $filter_start_date = new \DateTime("-{$settings['admin_default_date_filter_range_days']} days");
    }
    
    if (!empty($_GET['end'])) {
        try {
            $filter_end_date = new \DateTime($_GET['end']);
        } catch (\Exception $e) {
            $filter_end_date = new \DateTime("+{$settings['admin_default_date_filter_range_days']} days");
        }
    } else {
        $filter_end_date = new \DateTime("+{$settings['admin_default_date_filter_range_days']} days");
    }
    
    //@todo: exported CSV needs title row
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'final');
    
    $csvConfig = new \Goodby\CSV\Export\Standard\ExporterConfig();
    $csvConfig->setFromCharset('UTF-8')->setToCharset('UTF-8');
    
    $csvExporter = new \Goodby\CSV\Export\Standard\Exporter($csvConfig);
    
    $filename = 'Invoices_submitted_' . $filter_start_date->format('Y-m-d') . '_' . $filter_end_date->format('Y-m-d') . '.csv';
    
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=$filename");
    $csvExporter->export('php://output', $invoices);
    
    die();
}

/**
 * View
 */
$actions = array('fetch-invoice-items', 'fetch-invoice-files', 'fetch-invoice-notes', 'update-invoice-id-for-org', 'mark-invoice-as-unread', 'export');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = 'admin-submitted';
    
    require FS_PHP . '/header.php';
    
    $translate->addResource('l10n/header.json');
    require 'views/header.php';
    
    $translate->addResource('l10n/nav.json');
    require 'views/nav.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}