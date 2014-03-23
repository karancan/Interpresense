<?php

header('Content-Type: text/html; charset=utf-8');
header('HTTP/1.1 404 Not Found');

require_once '../php/config.php';

?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/base.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/skeleton.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <title>Interpreter Manager - Page not found /  Page introuvable</title>
    <body>
        <div class="container">
            <div>
                <i class="fa fa-spinner fa-5x"></i>
            </div>
            <div class="status-code">
                404
            </div>
            <div lang="en-CA">
                <div>
                    That page doesn't exist…
                </div>
            </div>
            <div lang="fr-CA">
                <div>
                    Cette page n'existe pas…
                </div>
            </div>
        </div>
    </body>
</html>