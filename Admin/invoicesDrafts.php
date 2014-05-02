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
$invoiceNotesModel = new InvoiceNotes($dbo);

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
    
    $filter_start_date = date("Y-m-d", strtotime('-' . $settings['admin_default_date_filter_range_days'] . ' days'));
    if (!empty($_GET['start'])){
        $filter_start_date = $_GET['start'];
    }
    $filter_end_date = date("Y-m-d", strtotime('+' . $settings['admin_default_date_filter_range_days'] . ' days'));
    if (!empty($_GET['end'])){
        $filter_end_date = $_GET['end'];
    }
    
    $invoices = $invoicesModel->fetchInvoices($filter_start_date, $filter_end_date, 'draft');
    
    $translate->addResource('l10n/invoicesDrafts.json');
    $viewFile = "views/invoicesDrafts.php"; //@todo: if no invoices to be shown, show appropriate message
    
} elseif ($_GET['page'] === "mark-invoice-as-finalized") {

    $invoicesModel->finalizeDraftInvoice($_GET['invoice_id']);
    
    $note = array(
        'invoice_id' => $_GET['invoice_id'],
        'note' => "Invoice finalized by {$_SESSION['first_name']} {$_SESSION['last_name']} on " . date('Y-m-d H:i:s')
    );
    
    $invoiceNotesModel->addNote($note);

} elseif ($_GET['page'] === "delete-invoice") {

    $invoicesModel->deleteInvoice($_GET['invoice_id']);
    $invoiceNotesModel->deleteInvoiceNotes($_GET['invoice_id']);
    
} elseif ($_GET['page'] === "export") {
    //@todo: add logic. Take in to account `start` and `end` from GET
    die();
}

/**
 * View
 */
$actions = array('mark-invoice-as-finalized', 'delete-invoice', 'export');

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