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
// @todo Figure this out

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    
    $unreadInvoiceCount = $invoicesModel->fetchUnreadFinalizedInvoiceCount();
    
    $reportsGenerated = $model->fetchReportsGenerated();
    $reportTemplates = $model->fetchReportTemplates();
    $reportPlaceholders = $placeholdersModel->fetchPlaceholders(0, 1);

    $translate->addResource('l10n/reports.json');
    $viewFile = "views/reports.php";
} elseif ($_GET['page'] === 'generate-new-report') {

    $reportID = $model->generateReport($_POST['template_id'], $_POST['report_name']);
    header("Location: reports.php?focus=report-$reportID");

} elseif ($_GET['page'] === 'view-generated-report') {
    
    $report = $model->fetchReport($_GET['report_id']);
    
    header("Content-Type: {$report['report_file_type']}");
    echo $report;
    
} elseif ($_GET['page'] === 'mark-report-as-deleted') {

    $model->deleteReport($_GET['report_id']);

} elseif ($_GET['page'] === 'add-template') {

    $templateID = $model->addReportTemplate($_POST);
    
    header("Location: reports.php?focus=template-$templateID");
    exit;

} elseif ($_GET['page'] === 'mark-template-as-deleted') {

    $model->deleteReportTemplate($_GET['template_id']);

}

/**
 * View
 */
$actions = array('generate-new-report', 'view-generated-report', 'mark-report-as-deleted', 'add-template', 'mark-template-as-deleted');

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