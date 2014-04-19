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
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR_FRONTEND ?>/bootstrap/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR_FRONTEND ?>/Bootflat/bootflat/css/bootflat.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR_FRONTEND ?>/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR_FRONTEND ?>/summernote/summernote-dist/summernote.css'>
    <link rel='stylesheet' href='//<?= URL_CSS ?>/interpresense.css'>

    <script src='//<?= URL_VENDOR_FRONTEND ?>/jquery/dist/jquery.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/jquery-color/jquery.color.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/bootstrap/dist/js/bootstrap.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/DataTables/media/js/jquery.dataTables.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/summernote/summernote-dist/summernote.min.js' charset='utf-8'></script>
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
            try {
                $translate->_e('documentTitleTag');
            } catch (\OutOfBoundsException $e) {
                echo 'Error';
            }
        ?>
    </title>
    <body>