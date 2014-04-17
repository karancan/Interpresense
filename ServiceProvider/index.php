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

/**
 * Localization
 */
if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
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
} else if ($_GET['page'] === 'invoice-submission') {
    
    //@todo: the case where the user submits the invoice and sees a confirmation message and next steps
    //@todo: trigger emails
    
    $translate->addResource('l10n/invoiceSubmission.json');
    $viewFile = "views/invoiceSubmission.php";
    
} else if ($_GET['page'] === 'invoice-retrieval') {
    
    //@todo:  the case where the user clicks a link on their email to retrieve an invoice and is shown the possible options
    //@todo: look for uid in the GET to be able to retrieve an invoice
    
    $translate->addResource('l10n/invoiceRetrieval.json');
    $viewFile = "views/invoiceRetrieval.php";
    
}

/**
 * View
 */
$actions = array('invoice-submission', 'invoice-retrieval');

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