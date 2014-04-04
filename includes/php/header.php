<?php 

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' or isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} else {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : null) );
    die();
}
session_start();

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>

    <link rel='shortcut icon' href='<?= URL_INTERPRESENSE ?>/favicon.ico'>    
    <link rel='stylesheet' media='screen' type='text/css' href='../includes/vendor/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='../includes/vendor/bootflat.min.css'>
    <link rel='stylesheet' href='../includes/vendor/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../includes/css/interpresense.css'>
    
    <script src='../includes/vendor/jquery.min.js' charset='utf-8'></script>
    <script src='../includes/vendor/jquery.dataTables.min.js' charset='utf-8'></script>
    <script src='../includes/vendor/bootstrap/js/bootstrap.min.js' charset='utf-8'></script>
    
    <!--[if lt IE 9]>
    <script src='../includes/vendor/html5shiv/html5shiv-printshiv.js' charset='utf-8'></script>
    <![endif]-->

    <meta name='application-name' content='Interpresense'>
    <meta name='msapplication-tooltip' content='Interpresense'>
    <meta name='msapplication-starturl' content='<?= URL_INTERPRESENSE ?>/'>    

    <title>
        Interpresense –
        <?php
            if(isset($page_title)) {
                echo $page_title;
            }
        ?>
    </title>
    <body>