<?php

header('Content-Type: text/html; charset=utf-8');
header('HTTP/1.1 403 Forbidden');

require_once '../php/config.php';

?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/base.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/skeleton.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <title>Interpreter Manager - Access denied / Accès refusé</title>
    <body>
        <div class="container">
            <div>
                <i class="fa fa-exclamation-triangle fa-5x"></i>
            </div>
            <div class="status-code">
                403
            </div>
            <div lang="en-CA">
                <div>
                    You do not have permission to access this resource
                    <br><br>
                    <span style="font-size: 0.7em;">
                        If you think you should be able to access this page please contact the Interpreter Manager team…
                    </span>
                </div>
            </div>
            <div lang="fr-CA">
                <div>
                    Vous n'avez pas la permission de voir cette page
                    <br><br>
                    <span style="font-size: 0.7em;">
                        Si vous pensez que vous devriez voir cette page, s'il vous plait contacter l'équipe Interpreter Manager…
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>