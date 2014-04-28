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
if (!isset($_SESSION['user_id'])) {
    header('location: https://' . URL_ADMIN . '/index.php?next=' . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}

/**
 * Models
 */
$model = new Settings($dbo);
$activitiesModel = new Activities($dbo);

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

    $activities = $activitiesModel->fetchActivities();
    $appSettings = $model->fetchSettings();
    
    $translate->addResource('l10n/settings.json');
    $viewFile = "views/settings.php";
    
} elseif ($_GET['page'] === 'change-setting') {
    $model->changeSetting($_POST['key'], $_POST['value']);
    header('location: settings.php?focus=' . $_POST['key']);
} elseif ($_GET['page'] === 'delete-setting') {
    $model->deleteSetting($_POST['key']);
} elseif ($_GET['page'] === 'change-activity') {
    
    if (empty($_POST['activity_id'])){
        $updated = $activitiesModel->addActivity($_POST);
    } else {
        $updated = $activitiesModel->updateActivity($_POST);
    }
    
    header('location: settings.php?focus=' . $updated);
} elseif ($_GET['page'] === 'delete-activity') {
    $activitiesModel->deleteActivity($_POST['activity_id']);
}

/**
 * View
 */
$actions = array('change-setting', 'delete-setting', 'change-activity', 'delete-activity');

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