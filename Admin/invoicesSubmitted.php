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
$invoiceItems = new \Interpresense\ServiceProvider\InvoiceItems($dbo);
$invoiceFiles = new \Interpresense\ServiceProvider\InvoiceFiles($dbo);
$invoiceNotes = new InvoiceNotes($dbo);

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

    $invoices = $invoicesModel->fetchInvoices();
    $translate->addResource('l10n/invoicesSubmitted.json');
    $viewFile = "views/invoicesSubmitted.php";
    
} else if ($_GET['page'] === "fetch-invoice-details") {
    
    $invoicesModel->markInvoiceViewed($_GET['invoice_id']);
    $invoice = $invoicesModel->fetchInvoice($_GET['invoice_id']);
    $items = $invoiceItems->fetchItems($_GET['invoice_id']);
    // @todo output
    
} else if ($_GET['page'] === "fetch-invoice-files") {
    
    $files = $invoiceFiles->fetchFiles($_GET['invoice_id']);
    // @todo output JSON encoding file content doesn't seem like a good idea
    
} else if ($_GET['page'] === "fetch-invoice-notes") {

    $notes = $invoiceNotes->fetchNotes($_GET['invoice_id']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($notes);
    exit;
    
} else if ($_GET['page'] === "mark-invoice-as-draft") {
    
    $invoicesModel->markInvoiceAsDraft($_GET['invoice_id']);
    //@todo: create an invoice note stating that the invoice was mark as un-approved (or as a draft)

} else if ($_GET['page'] === "export") {
    //@todo: add logic
    die();
}

/**
 * View
 */
$actions = array('fetch-invoice-details', 'fetch-invoice-files', 'fetch-invoice-notes', 'mark-invoice-as-draft', 'export');

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