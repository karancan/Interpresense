<?php

namespace Interpresense\Admin;

use Interpresense\Includes\AntiXss;

/**
 * Session
 */
session_start();
if (!isset($_SESSION['admin']['user_id'])) {
    header('location: https://' . URL_ADMIN . '/index.php?next=' . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}

/**
 * Configuration file, database object, settings and Anti XSS
 */
require '../includes/php/config.php';
$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);
$antiXSS = new AntiXss();

/**
 * Models
 */
$usersModel = new Users($dbo);
$emailTemplatesModel = new Emails($dbo);
$invoicesModel = new \Interpresense\ServiceProvider\Invoice($dbo);
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
$numFmt = new \JsonI18n\NumberFormat(\Locale::getDefault());
$numFmt->addResource(FS_L10N . '/numberFormatters.json');

/**
 * Content and actions
 */
if (!isset($_GET['page'])) {

    $unreadInvoiceCount = $invoicesModel->fetchUnreadFinalizedInvoiceCount();
    
    $users = $usersModel->fetchUsers();
    
    $translate->addResource('l10n/settings.json');
    $viewFile = "views/users.php";
    
} elseif ($_GET['page'] === 'change-user') {

    if (empty($_POST['user_id'])){
        $updated = $usersModel->createUser($_POST);
        
        try {
            $emailData = $emailTemplatesModel->fetchEmailTemplate(1);
            
            require_once FS_VENDOR_BACKEND . '/swiftmailer/lib/swift_required.php';
            
            $body = $placeholdersModel->replaceInstitutionHashtags($emailData['content']);
            $body = $placeholdersModel->replaceUserHashtags($body, $updated);
            
            $transport = new \Swift_SmtpTransport(SMTP_SERVER, SMTP_SERVER_PORT);
            $mailer = new \Swift_Mailer($transport);
            
            $message = new \Swift_Message("Interpresense - {$emailData['subject']}");
            $message->setFrom(EMAIL_ALIAS_NO_REPLY . EMAIL_ORG_STAFF_DOMAIN)
                ->setTo($_POST['user_name'] . EMAIL_ORG_STAFF_DOMAIN)
                ->setBody($body, 'text/html', 'utf-8');
            
            if (!empty($emailData['cc'])) {
                $message->setCc($emailData['cc']);
            }
            
            if (!empty($emailData['bcc'])) {
                $message->setBcc($emailData['bcc']);
            }

            $mailer->send($message);
        } catch (\Exception $e) {
            // Email failed
        }
        
    } else {
        $updated = $usersModel->updateUser($_POST);
        
        try {
            $emailData = $emailTemplatesModel->fetchEmailTemplate(2);
            
            require_once FS_VENDOR_BACKEND . '/swiftmailer/lib/swift_required.php';
            
            $body = $placeholdersModel->replaceInstitutionHashtags($emailData['content']);
            $body = $placeholdersModel->replaceUserHashtags($body, $updated);
            
            $transport = new \Swift_SmtpTransport(SMTP_SERVER, SMTP_SERVER_PORT);
            $mailer = new \Swift_Mailer($transport);
            
            $message = new \Swift_Message("Interpresense - {$emailData['subject']}");
            $message->setFrom(EMAIL_ALIAS_NO_REPLY . EMAIL_ORG_STAFF_DOMAIN)
                ->setTo($_POST['user_name'] . EMAIL_ORG_STAFF_DOMAIN)
                ->setBody($body, 'text/html', 'utf-8');
            
            if (!empty($emailData['cc'])) {
                $message->setCc($emailData['cc']);
            }
            
            if (!empty($emailData['bcc'])) {
                $message->setBcc($emailData['bcc']);
            }

            $mailer->send($message);
        } catch (\Exception $e) {
            // Email failed
        }
    }
    
    header('Location: users.php?focus=' . $updated);
    exit;
    
} elseif ($_GET['page'] === 'export-users') {
    
    $data = $usersModel->fetchUsers();
    
    $csvConfig = new \Goodby\CSV\Export\Standard\ExporterConfig();
    $csvConfig->setFromCharset('UTF-8')->setToCharset('UTF-8');
    
    $csvExporter = new \Goodby\CSV\Export\Standard\Exporter($csvConfig);
    
    $filename = 'Interpresense_Users_' . date('Ymd\THis') . '.csv';
    
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=$filename");
    
    if (sizeof($data) > 0) {
        array_unshift($data, array_keys($data[0]));
    }
    $csvExporter->export('php://output', $data);
    exit;
}

/**
 * View
 */
$actions = array('export-users');

if (!in_array($_GET['page'], $actions, true)) {
    
    $current_view = '';
    
    $translate->addResource(FS_L10N . '/footer.json');
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