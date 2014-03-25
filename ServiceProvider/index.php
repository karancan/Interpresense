<?php

namespace Interpresense\ServiceProvider;

/**
 * Session
 */
session_start();

/**
 * Configuration file and settings
 */
require '../includes/php/config.php';
// @todo Determine settings loader

/**
 * Models
 */

/**
 * Localization
 */
require FS_VENDOR . '/JsonI18n.php';

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
}
\Locale::setDefault($_SESSION['lang']);

// Translation
$translate = new \JsonI18n(\Locale::getDefault());
// @todo Add resource files using $translate->addResource($file)

// Date formatting
// @todo Figure this out
// Perhaps $dateFmt = new \JsonI18nDate(\Locale::getDefault());

// Number formatting
// @todo Also figure this out

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