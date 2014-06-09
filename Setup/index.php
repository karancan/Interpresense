<?php

namespace Interpresense\Setup;

use Interpresense\Includes\AntiXss;

/**
 * Session
 */
session_start();

/**
 * Configuration file, database object, settings and Anti XSS
 */
require '../includes/php/config.php';

//If the user is trying to begin installation, there is no point in attempting a connection
if ($_GET['page'] !== '' && $_GET['page'] !== 'go-to-step-1'){
    $dbo = new \Interpresense\Includes\DatabaseObject();
    $settings = \Interpresense\Includes\ApplicationSettings::load($dbo);
    $antiXSS = new AntiXss();
}

/**
 * Models
 */
//If the user is trying to begin installation, there is no model to be initiated
if ($_GET['page'] !== '' && $_GET['page'] !== 'go-to-step-1'){
    $model = new Setup($dbo);
    $usersModel = new \Interpresense\Admin\Users($dbo);
}

/**
 * Localization
 */
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
    
    //By default, we always just deflect to step 1
    header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-1');
    exit;
    
} elseif ($_GET['page'] === 'go-to-step-1') {

    $setup_current_step = 1;
    $translate->addResource('l10n/step1Database.json');
    $viewFile = "views/step1Database.php";
    
} elseif ($_GET['page'] === 'go-to-step-2') {
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
        exit;
    }
    
    if ($settings['installation_accepted_eula']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-3');
        exit;
    }
    
    $model->createTables();
    
    $setup_current_step = 2;
    $translate->addResource('l10n/step2Eula.json');
    $viewFile = "views/step2Eula.php";
    
} elseif ($_GET['page'] === 'go-to-step-3') {
    
    $model->acceptEula();
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
        exit;
    }
    
    if (!$settings['installation_accepted_eula']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-2');
        exit;
    }
    
    $users = $usersModel->fetchUsers();
    
    $setup_current_step = 3;
    $translate->addResource('l10n/step3Users.json');
    $viewFile = "views/step3Users.php";

} elseif ($_GET['page'] === 'go-to-step-4') {
    
    if ($settings['installation_complete']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-5');
        exit;
    }
    
    if (!$settings['installation_accepted_eula']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-2');
        exit;
    }
    
    $usersModel->createUser($_POST);
    
    $settingsModel = new \Interpresense\Admin\Settings($dbo);
    $settings = $settingsModel->fetchSettings();
    
    $setup_current_step = 4;
    $translate->addResource('l10n/step4Settings.json');
    $viewFile = "views/step4Settings.php";
    
} elseif ($_GET['page'] === 'go-to-step-5') {
    
    //@todo: save data from step 4
    
    if (!$settings['installation_accepted_eula']) {
        header('Location: https://'  . URL_SETUP . '/index.php?page=go-to-step-2');
        exit;
    }
    
    $model->finishInstallation();
    
    $setup_current_step = 5;
    $translate->addResource('l10n/step5Complete.json');
    $viewFile = "views/step5Complete.php";
    
}

/**
 * View
 */
$actions = array();

if (!in_array($_GET['page'], $actions, true)) {
    
    $translate->addResource(FS_L10N . '/footer.json');
    require FS_PHP . '/header.php';
    require 'views/header.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}