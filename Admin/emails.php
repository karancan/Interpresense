<?php

namespace Interpresense\Admin;

use Interpresense\Includes\AntiXss;

/**
 * Session
 */
session_start();
if (!isset($_SESSION['admin']['user_id'])) {
    header('location: https://' . URL_ADMIN . '/index.php?next=' . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}

/**
 * Configuration file, database object, settings and Anti XSS
 */
require '../includes/php/config.php';
$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);
$antiXSS = new AntiXss();

/**
 * Models
 */
$model = new Emails($dbo);
$placeholdersModel = new Placeholders($dbo);
$invoicesModel = new \Interpresense\ServiceProvider\Invoice($dbo);

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
    
    $emailTemplates = $model->fetchEmailTemplates();
    $emailPlaceholders = $placeholdersModel->fetchPlaceholders(1, 0);
    
    $translate->addResource('l10n/emails.json');
    $viewFile = "views/emails.php";
    
} elseif ($_GET['page'] === 'update-email') {
    
    $model->updateEmailTemplate($_POST);
    header('Location: emails.php?focus=' . $_POST['email_id']);   
    exit;
}

/**
 * View
 */
$actions = array('update-email');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = '';
    
    $translate->addResource(FS_L10N . '/footer.json');
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