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
// @todo Figure this out

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    
    $unreadInvoiceCount = $invoicesModel->fetchUnreadFinalizedInvoiceCount();
    
    //@todo: add ability to view approved invoices only

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
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'final');
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
    
    //@todo: give the user the ability to mark an invoice as read/unread
    //@todo: fetch the details of who viewed invoice last and when
    
    $invoicesModel->markInvoiceViewed($_POST['invoice_id']);
    
    header('Content-Type: application/json; charset=utf-8');
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
    echo json_encode(array('items' => $items, 'grand_total' => $grandTotal));
    exit;
    
} else if ($_GET['page'] === "fetch-invoice-files") {
    
    header('Content-Type: application/json; charset=utf-8');
    $files = $invoicesFilesModel->fetchFiles($_POST['invoice_id']);
    foreach ($files as &$f){
        $f['inserted_on'] = $dateFmt->format($f['inserted_on'], 'date_time');
    }
    unset($f);
    echo json_encode($files);
    exit;
    
} elseif ($_GET['page'] === "view-file") {
    
    //@todo: spit out file
    
} else if ($_GET['page'] === "fetch-invoice-notes") {

    header('Content-Type: application/json; charset=utf-8');
    $notes = $invoicesNotesModel->fetchNotes($_POST['invoice_id']);
    foreach ($notes as &$n){
        $n['inserted_on'] = $dateFmt->format($n['inserted_on'], 'date_time');
    }
    unset($n);
    echo json_encode($notes);
    exit;
    
} elseif ($_GET['page'] === "add-note"){
    
    $invoicesNotesModel->addNote($_POST);
    header('Location: invoicesSubmitted.php?focus=' . $_POST['invoice_id']);

} else if ($_GET['page'] === "mark-invoice-as-draft") {
    
    $invoicesModel->markInvoiceAsDraft($_GET['invoice_id']);
    //@todo: create an invoice note stating that the invoice was mark as un-approved (or as a draft)
    //@todo: send email to service provider telling them the invoice was marked as a draft with the note attached

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
$actions = array('fetch-invoice-items', 'fetch-invoice-files', 'fetch-invoice-notes', 'mark-invoice-as-draft', 'export');

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