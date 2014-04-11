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

/**
 * Models
 */
// @todo Plug in a model

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
    
    //@todo: if session is already set, go to another page (remember to treat $_GET['next'])
    
    $translate->addResource('l10n/login.json');
    $viewFile = "views/login.php";
} else if ($_GET['page'] === "attempt-login") {
    
    //@todo: check if the user has good credentials upon form submit. If yes, go to another page (remember to treat $_GET['next'])
    //If not, go to this controller with error in query string
    
    if (!empty($_GET['next'])){
        header('location: ' . $_GET['next']);
    } else {
        header('location: invoicesExpected.php');
    }
    
} else if ($_GET['page'] === "register-or-reset") {
    $translate->addResource('l10n/registerOrReset.json');
    $viewFile = "views/registerOrReset.php";
} else if ($_GET['page'] === "logout") {
    session_destroy();
    header('location: https://'  . URL_ADMIN);
}

/**
 * View
 */
$actions = array();

if (!in_array($_GET['page'], $actions, true)) {

    $current_view = '';
    
    require FS_PHP . '/header.php';
    require 'views/header.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}