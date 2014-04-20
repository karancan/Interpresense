<?php

namespace Interpresense\ServiceProvider;

use Interpresense\Includes\AntiXss;

/**
 * Session
 */
session_start();

/**
 * Configuration file, database object, and settings
 */
require '../includes/php/config.php';

$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);

$antiXSS = new AntiXss();

/**
 * Models
 */
$invoice = new Invoice($dbo);
$invoiceItems = new InvoiceItems($dbo);

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

    //@todo: first we need to check if installation is complete. If yes, continue, If not, go to setup module

    $translate->addResource('l10n/invoice.json');
    $viewFile = "views/invoice.php";
} elseif ($_GET['page'] === 'invoice-submission') {
    
    //@todo: the case where the user submits the invoice and sees a confirmation message and next steps
    //@todo: trigger emails
    
    $translate->addResource('l10n/invoiceSubmission.json');
    $viewFile = "views/invoiceSubmission.php";
    
} elseif ($_GET['page'] === 'invoice-retrieval') {
    
    //@todo:  the case where the user clicks a link on their email to retrieve an invoice and is shown the possible options
    if (isset($_GET['uid'])) {
        
        try {
            $draft = $invoice->loadDraftInvoice($_GET['uid']);
            $items = $invoiceItems->fetchItems($draft['invoice_id']);
        
            $translate->addResource('l10n/invoiceRetrieval.json');
            $viewFile = "views/invoiceRetrieval.php";
        } catch (\InvalidArgumentException $e) {
            // Invalid UID
            // This block is intentionally left empty to fall back to the error page
        }
    }
    
}

/**
 * View
 */
$actions = array('invoice-retrieval');

if (!in_array($_GET['page'], $actions, true)) {

    require FS_PHP . '/header.php';
    
    $translate->addResource('l10n/header.json');
    require 'views/header.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}