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
        
    <link rel="stylesheet" media="screen" type="text/css" href="../includes/css/base.css">
    <link rel="stylesheet" media="screen" type="text/css" href="../includes/css/layout.css">
    <link rel="stylesheet" media="screen" type="text/css" href="../includes/css/skeleton.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <meta name='application-name' content='Interpreter Manager'>
    <meta name='msapplication-tooltip' content='Interpreter Manager'>
    <meta name='msapplication-starturl' content='<?= URL_INTRANET_INTERPRETER ?>/'>    

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