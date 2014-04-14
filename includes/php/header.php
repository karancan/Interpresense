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

    <link rel='shortcut icon' href='//<?= URL_INTERPRESENSE ?>/favicon.ico'>    
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR ?>/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR ?>/bootflat.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR ?>/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR ?>/summernote/dist/summernote.css'>
    <link rel='stylesheet' href='//<?= URL_CSS ?>/interpresense.css'>

    <script src='//<?= URL_VENDOR ?>/jquery.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR ?>/jquery.dataTables.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR ?>/bootstrap/js/bootstrap.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR ?>/summernote/dist/summernote.min.js' charset='utf-8'></script>
    <script src='//<?= URL_JS ?>/interpresense.js' charset='utf-8'></script>
    
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