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
    
    //@todo: check if installation has already been completed
    //@todo: if installation is complete, go to step 4
    
    //Installation not complete
    header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-1');
    exit;
    
} else if ($_GET['page'] === 'go-to-step-1') {
    
    $setup_current_step = 1;
    $translate->addResource('l10n/step1Database.json');
    $viewFile = "views/step1Database.php";
    
} else if ($_GET['page'] === 'go-to-step-2') {
    
    //@todo: save data from step 1
    
    $setup_current_step = 2;
    $translate->addResource('l10n/step2Users.json');
    $viewFile = "views/step2Users.php";
    
} else if ($_GET['page'] === 'go-to-step-3') {
    
    //@todo: save data from step 2
    
    $setup_current_step = 3;
    $translate->addResource('l10n/step3Settings.json');
    $viewFile = "views/step3Settings.php";

} else if ($_GET['page'] === 'go-to-step-4') {
    
    //@todo: save data from step 3
    
    $setup_current_step = 4;
    $translate->addResource('l10n/step4Complete.json');
    $viewFile = "views/step4Complete.php";
    
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