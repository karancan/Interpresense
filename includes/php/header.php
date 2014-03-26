<?php 

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' or isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} else {
    $uri = 'https://' . URL_INTRANET . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
    header('HTTP/1.1 301 Moved Permanently');
    header("Location: $uri");
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
        Interpreter Manager –
        <?php
            if(isset($page_title)) {
                echo $page_title;
            }
        ?>
    </title>
    <body>
        <div class="container">