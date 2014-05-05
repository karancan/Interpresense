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
if (!isset($_SESSION['user_id'])) {
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
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'draft');
    if (!empty($invoices)){
        foreach ($invoices as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    $translate->addResource('l10n/invoicesDrafts.json');
    $viewFile = "views/invoicesDrafts.php"; //@todo: if no invoices to be shown, show appropriate message
    
} elseif ($_GET['page'] === "fetch-invoice-items") {
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($invoicesItemsModel->fetchItems($_POST['invoice_id']));
    exit;
    
} elseif ($_GET['page'] === "fetch-invoice-files") {
    
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
    
} elseif ($_GET['page'] === "fetch-invoice-notes") {
    
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
    header('Location: invoicesDrafts.php?focus=' . $_POST['invoice_id']);

} elseif ($_GET['page'] === "export") {
    
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
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'draft');
    
    $csvConfig = new \Goodby\CSV\Export\Standard\ExporterConfig();
    $csvConfig->setFromCharset('UTF-8')->setToCharset('UTF-8');
    
    $csvExporter = new \Goodby\CSV\Export\Standard\Exporter($csvConfig);
    
    $filename = 'Invoice_drafts_' . $filter_start_date->format('Y-m-d') . '_' . $filter_end_date->format('Y-m-d') . '.csv';
    
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=$filename");
    $csvExporter->export('php://output', $invoices);
    
    die();
}

/**
 * View
 */
$actions = array('fetch-invoice-items', 'fetch-invoices-files', 'fetch-invoice-notes', 'export');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = 'admin-drafts';
    
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