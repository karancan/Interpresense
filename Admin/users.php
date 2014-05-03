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
$usersModel = new Users($dbo);
$emailTemplatesModel = new Emails($dbo);

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

    $users = $usersModel->fetchUsers();
    
    $translate->addResource('l10n/settings.json');
    $viewFile = "views/users.php";
    
} elseif ($_GET['page'] === 'change-user') {

    if (empty($_POST['user_id'])){
        $updated = $usersModel->createUser($_POST);
        
        try {
            $emailData = $emailTemplatesModel->fetchEmailTemplate(1);
            
            $transport = \Swift_SmtpTransport::newInstance(SMTP_SERVER, SMTP_SERVER_PORT);

            $email = \Swift_Message::newInstance()
                ->setSubject("Interpresense - {$emailData['subject']}")
                ->setFrom(EMAIL_ALIAS_NO_REPLY . EMAIL_ORG_STAFF_DOMAIN)
                ->setTo($_POST['user_name'] . EMAIL_ORG_STAFF_DOMAIN)
                ->setBody($emailData['content']);
                
            if (!empty($emailData['cc'])) {
                $email->setCc($emailData['cc']);
            }
            
            if (!empty($emailData['bcc'])) {
                $email->setBcc($emailData['bcc']);
            }

            $transport->send($email);
        } catch (\Exception $e) {
            // Email failed
        }
        
    } else {
        $updated = $usersModel->updateUser($_POST);
        
        try {
            $emailData = $emailTemplatesModel->fetchEmailTemplate(2);
            
            $transport = \Swift_SmtpTransport::newInstance(SMTP_SERVER, SMTP_SERVER_PORT);

            $email = \Swift_Message::newInstance()
                ->setSubject("Interpresense - {$emailData['subject']}")
                ->setFrom(EMAIL_ALIAS_NO_REPLY . EMAIL_ORG_STAFF_DOMAIN)
                ->setTo($_POST['user_name'] . EMAIL_ORG_STAFF_DOMAIN)
                ->setBody($emailData['content']);
                
            if (!empty($emailData['cc'])) {
                $email->setCc($emailData['cc']);
            }
            
            if (!empty($emailData['bcc'])) {
                $email->setBcc($emailData['bcc']);
            }

            $transport->send($email);
        } catch (\Exception $e) {
            // Email failed
        }
    }
    
    header('Location: users.php?focus=' . $updated);
    
} elseif ($_GET['page'] === 'export-users') {
    //@todo: add logic
    die();
}

/**
 * View
 */
$actions = array('export-users');

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