<?php

namespace Interpresense\Setup;

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

/**
 * Models
 */
//@todo: add

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
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
    }
    
    //@todo: check if EULA has been accepted. If yes, to step 2. Else step 1.
    
    //Installation not complete and EULA not accepted
    header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-1');
    exit;
    
} elseif ($_GET['page'] === 'go-to-step-1') {
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
    }
    
    $setup_current_step = 1;
    $translate->addResource('l10n/step1Eula.json');
    $viewFile = "views/step1Eula.php";
    
} elseif ($_GET['page'] === 'go-to-step-2') {
    
    //@todo: save data from step 1
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
    }
    
    //@todo: check if EULA has been accepted. If yes, continue. Else step 1.
    
    $setup_current_step = 2;
    $translate->addResource('l10n/step2Database.json');
    $viewFile = "views/step2Database.php";
    
} elseif ($_GET['page'] === 'go-to-step-3') {
    
    //@todo: save data from step 2
    //@todo: fetch list of existing users
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
    }
    //@todo: check if EULA has been accepted. If yes, continue. Else step 1.
    
    $setup_current_step = 3;
    $translate->addResource('l10n/step3Users.json');
    $viewFile = "views/step3Users.php";

} elseif ($_GET['page'] === 'go-to-step-4') {
    
    //@todo: save data from step 3
    //@todo: fetch app settings
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
    }
    //@todo: check if EULA has been accepted. If yes, continue. Else step 1.
    
    $setup_current_step = 4;
    $translate->addResource('l10n/step4Settings.json');
    $viewFile = "views/step4Settings.php";
    
} elseif ($_GET['page'] === 'go-to-step-5') {
    
    //@todo: save data from step 4
    //@todo: check if EULA has been accepted. If yes, continue. Else step 1.
    
    $setup_current_step = 5;
    $translate->addResource('l10n/step5Complete.json');
    $viewFile = "views/step5Complete.php";
    
}

/**
 * View
 */
$actions = array();

if (!in_array($_GET['page'], $actions, true)) {
    
    require FS_PHP . '/header.php';
    require 'views/header.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}