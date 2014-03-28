<?php

namespace Interpresense\ServiceProvider;

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

/**
 * Models
 */
$invoice = new Invoice($dbo);

/**
 * Localization
 */
require FS_VENDOR . '/JsonI18n/Translate.php';
require FS_VENDOR . '/JsonI18n/DateFormat.php';

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
}
\Locale::setDefault($_SESSION['lang']);

// Translation
$translate = new \JsonI18n\Translate(\Locale::getDefault());
$translate->addResource('l10n/index.json');

// Date formatting
$dateFmt = new \JsonI18n\DateFormat(\Locale::getDefault());
$dateFmt->addResource(FS_L10N . '/dateFormatters.json');

// Number formatting
// @todo Figure this out

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    $viewFile = "views/index.php";
} else {
    require_once FS_PHP.'/error.php';
}

/**
 * View
 */
$actions = array('');

if (!in_array($_GET['page'], $actions, true)) {

    require FS_PHP . '/header.php';
    require 'views/nav.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}