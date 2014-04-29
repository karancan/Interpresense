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
$model = new Reports($dbo);
$placeholdersModel = new Placeholders($dbo);

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

    $reportsGenerated = $model->fetchReportsGenerated();
    $reportTemplates = $model->fetchReportTemplates();
    $reportPlaceholders = $placeholdersModel->fetchPlaceholders(0, 1);

    $translate->addResource('l10n/reports.json');
    $viewFile = "views/reports.php";
} elseif ($_GET['page'] === 'generate-new-report') {

    //@todo: Add a newly generated report to the database

} elseif ($_GET['page'] === 'view-generated-report') {
    
    //@todo: Given a report ID, display the report
    
} elseif ($_GET['page'] === 'mark-report-as-deleted') {

    //@todo: Given a report ID, mark it as deleted

} elseif ($_GET['page'] === 'add-template') {

    //@todo: Add a new report template

} elseif ($_GET['page'] === 'mark-template-as-deleted') {

    //@todo: Given a template ID, mark it as deleted

}

/**
 * View
 */
$actions = array();

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = 'admin-reports';
    
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