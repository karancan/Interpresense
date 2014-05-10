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
$model = new Search($dbo);
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
    
    //Does the search query match any invoices pertaining to a client
    $finalInvoicesForClient = $model->fetchFinalizedInvoicesForClient($_GET['q']);
    if (!empty($finalInvoicesForClient)){
        foreach ($finalInvoicesForClient as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    $draftInvoicesForClient = $model->fetchDraftInvoicesForClient($_GET['q']);
    if (!empty($draftInvoicesForClient)){
        foreach ($draftInvoicesForClient as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    //Does the search query match any invoices pertaining to a service provider
    $finalInvoicesForSP = $model->fetchFinalizedInvoicesForServiceProvider($_GET['q']);
    if (!empty($finalInvoicesForSP)){
        foreach ($finalInvoicesForSP as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    $draftInvoicesForSP = $model->fetchDraftInvoicesForServiceProvider($_GET['q']);
    if (!empty($draftInvoicesForSP)){
        foreach ($draftInvoicesForSP as &$i){
            $i['item_count'] = $invoicesItemsModel->fetchItemsCount($i['invoice_id']);
            $i['file_count'] = $invoicesFilesModel->fetchFilesCount($i['invoice_id']);
            $i['note_count'] = $invoicesNotesModel->fetchNotesCount($i['invoice_id']);
        }
        unset($i);
    }
    
    $translate->addResource('l10n/search.json');
    $viewFile = "views/search.php";
}

/**
 * View
 */
$actions = array();

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = '';
    
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