<?php

namespace Interpresense\Admin;

use Interpresense\Includes\AntiXss;

/**
 * Configuration file, database object, and settings
 */
require '../includes/php/config.php';

/**
 * Session
 */
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: https://' . URL_ADMIN . '/index.php?next=' . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}

$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);

$antiXSS = new AntiXss();

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
// @todo Plug in a l10n resource file

// Date formatting
$dateFmt = new \JsonI18n\DateFormat(\Locale::getDefault());
$dateFmt->addResource(FS_L10N . '/dateFormatters.json');

// Number formatting
// @todo Figure this out

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    
    //@todo: check if $_GET['student'] is valid and fetch student details. If invalid adjust view.
    
    //@todo: fetch student expected invoices
    //@todo: fetch student submitted invoices
    //@todo: fetch student draft invoices
    
    $translate->addResource('l10n/studentSearch.json');
    $viewFile = "views/studentSearch.php";
} else {
    require_once FS_PHP.'/error.php';
}

/**
 * View
 */
$actions = array('');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = '';
    
    require FS_PHP . '/header.php';
    require 'views/header.php';
    require 'views/nav.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}