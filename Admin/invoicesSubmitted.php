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
// @todo Plug in a model

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

    //@todo: fetch non-draft invoices from `interpresense_service_provider_invoices`. Take in to account `start` and `end` from GET
    
    $translate->addResource('l10n/invoicesSubmitted.json');
    $viewFile = "views/invoicesSubmitted.php"; //@todo: if no invoices to be shown, show appropriate message
    
} else if ($_GET['page'] === "fetch-invoice-details") {
    
    //@todo: mark invoice as viewed
    //@todo: given an invoice ID, fetch everything about an invoice itself
    //@todo: given an invoice ID, fetch invoice items
    
} else if ($_GET['page'] === "fetch-invoice-files") {
    
    //@todo: given an invoice ID, fetch all the files belonging to that invoice
    
} else if ($_GET['page'] === "fetch-invoice-notes") {

    //@todo: given an invoice ID, fetch all the notes belonging to that invoice
    
} else if ($_GET['page'] === "mark-invoice-as-draft") {

    //@todo: for a given invoice id, mark `is_approved` as 0 and nullify the fields that state who approved it and when
    //@todo: create an invoice note stating that the invoice was mark as un-approved (or as a draft)

} else if ($_GET['page'] === "export") {
    //@todo: add logic. Take in to account `start` and `end` from GET
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