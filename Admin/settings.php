<?php

namespace Interpresense\Admin;

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
$model = new ApplicationSettings($dbo);

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
    $appSettings = $model->fetchSettings();
    $viewFile = "views/settings.php";
} elseif ($_GET['page'] === 'change-setting') {
    $model->changeSetting($_POST['key'], $_POST['value']);
} elseif ($_GET['page'] === 'delete-setting') {
    $model->deleteSetting($_POST['key']);
} else {
    require_once FS_PHP.'/error.php';
}

/**
 * View
 */
$actions = array('change-setting');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = 'admin-settings';
    
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