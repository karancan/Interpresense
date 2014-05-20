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
$emails = new Emails($dbo);

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
$numFmt = new \JsonI18n\NumberFormat(\Locale::getDefault());
$numFmt->addResource(FS_L10N . '/numberFormatters.json');

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {
    
    //@todo: first we need to check if installation is complete. If yes, continue, If not, go to setup module
    
    if (isset($_SESSION['admin']['user_id'])){
        
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
            $_SESSION['admin']['user_id'] = $user['user_id'];
            $_SESSION['admin']['first_name'] = $user['first_name'];
            $_SESSION['admin']['last_name'] = $user['last_name'];
            $_SESSION['admin']['last_log_in'] = $user['last_log_in'];

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
    
} elseif ($_GET['page'] === "confirm-registration") {
    
    $translate->addResource('l10n/register.json');
    $viewFile = "views/register.php";
    
} elseif ($_GET['page'] === "reset-password") {
    
    $translate->addResource('l10n/resetPassword.json');
    $viewFile = "views/resetPassword.php";
    
} elseif ($_GET['page'] === "initiate-reset") {
    
    $resetHash = $users->requestPasswordReset($_POST['username'], $_POST['user_password']);
    if (empty($resetHash)) {
        header('Location: index.php?page=reset-password&mode=initiate-reset-fail');
        exit;
    }
    
    require_once FS_VENDOR_BACKEND . '/swiftmailer/lib/swift_required.php';
    
    $template = $emails->fetchEmailTemplate(3);
    
    // Replace the hashtag
    $link = 'https://' . URL_ADMIN . '/index.php?page=confirm-reset&username=' . $antiXSS->escape($_POST['username'], AntiXss::URL_PARAM) . '&reset_key=' . $antiXSS->escape($resetHash, AntiXss::URL_PARAM);
    $body = str_replace('#passwordResetLink', $link, $template['content']);

    $transport = new \Swift_SmtpTransport(SMTP_SERVER, SMTP_SERVER_PORT);
    $mailer = new \Swift_Mailer($transport);

    $message = new \Swift_Message($template['subject']);
    $message->setFrom(EMAIL_ALIAS_NO_REPLY . EMAIL_ORG_STAFF_DOMAIN)
        ->setTo($_POST['username'] . EMAIL_ORG_STAFF_DOMAIN)
        ->setCc($template['cc'])
        ->setBody($body, 'text/html', 'utf-8');

    $mailer->send($message);
    
    $state = 'pending';
    $translate->addResource('l10n/confirmReset.json');
    $viewFile = "views/confirmReset.php";
    
} elseif ($_GET['page'] === "confirm-reset") {
    
    try {
        if ($users->confirmPasswordReset($_GET['username'], $_GET['reset_key'])) {
            $state = 'success';
        } else {
            $state = 'fail';
        }
    } catch (\Exception $e) {
        $state = 'fail';
    }
    
    $translate->addResource('l10n/confirmReset.json');
    $viewFile = "views/confirmReset.php";
    
} elseif ($_GET['page'] === "logout") {
    unset($_SESSION['admin']);
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
    
    $translate->addResource('l10n/header.json');
    require 'views/header.php';

    if(isset($viewFile) && file_exists($viewFile)) {
        require $viewFile;
    } else {
        require FS_PHP . '/error.php';
    }

    require FS_PHP . '/footer.php';
}