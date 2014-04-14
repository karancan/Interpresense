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
$users = new Users($dbo);

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
    
    if (isset($_SESSION['user_id'])){
        
        if (!empty($_GET['next'])) {
            header("Location: {$_GET['next']}");
            exit;
        }

        header('Location: invoicesSubmitted.php');
        exit;
        
    }
    
    $translate->addResource('l10n/login.json');
    $viewFile = "views/login.php";
} else if ($_GET['page'] === "attempt-login") {
    
    $user = $users->login($_POST['user_name'], $_POST['user_password']);
    
    if($user) {
        if($user['is_confirmed'] === '0') {
        
            header('Location: https://'  . URL_ADMIN . '/index.php?mode=unconfirmed-user');
            exit;

        } elseif($user['expires_on'] <= new \DateTime()) {
            
            header('Location: https://'  . URL_ADMIN . '/index.php?mode=expired-user');
            exit;
            
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['last_log_in'] = $user['last_log_in'];

            if (!empty($_GET['next'])) {
                header("Location: {$_GET['next']}");
                exit;
            }

            header('Location: invoicesSubmitted.php');
            exit;
        }
    } else {
        header('Location: https://'  . URL_ADMIN . '/index.php?mode=login-failed');
        exit;
    }
    
} else if ($_GET['page'] === "register-or-reset") {
    $translate->addResource('l10n/registerOrReset.json');
    $viewFile = "views/registerOrReset.php";
} else if ($_GET['page'] === "logout") {
    session_destroy();
    header('Location: https://'  . URL_ADMIN);
    exit;
}

/**
 * View
 */
$actions = array('attempt-login', 'logout');

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