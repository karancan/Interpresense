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
$activitiesModel = new \Interpresense\Admin\Activities($dbo);

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

    if (!$settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/');
        exit;
    }
    
    $activities = $activitiesModel->fetchActivities();

    $translate->addResource('l10n/invoice.json');
    $viewFile = "views/invoice.php";
} elseif ($_GET['page'] === 'invoice-submission') {
    
    $final = isset($_POST['mode']) && $_POST['mode'] === 'final';
    
    // Flip keys so that items are in rows not columns
    foreach ($_POST['description'] as $key => $val) {
        $_POST['invoice_items'][$key] = array(
            'description' => $_POST['description'][$key],
            'course_code' => $_POST['course_code'][$key],
            'activity_id' => $_POST['activity_id'][$key],
            'service_date' => $_POST['service_date'][$key],
            'start_time' => $_POST['start_time'][$key],
            'end_time' => $_POST['end_time'][$key],
            'rate' => $_POST['rate'][$key]
        );
    }
    unset($_POST['description'], $_POST['course_code'], $_POST['activity_id'], $_POST['service_date'], $_POST['start_time'], $_POST['end_time'], $_POST['rate']);
    
    $dbo->db->beginTransaction();
    $invoiceID = $invoice->addInvoice($_POST, $final);
    $invoiceItems->changeItems($invoiceID, $_POST['invoice_items']);
    $dbo->db->commit();
    
    //@todo: trigger emails
    
    $translate->addResource('l10n/invoiceSubmission.json');
    $viewFile = "views/invoiceSubmission.php";
    
} elseif ($_GET['page'] === 'invoice-retrieval') {
    
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
$actions = array();

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