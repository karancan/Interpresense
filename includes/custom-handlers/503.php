<?php

header('Content-Type: text/html; charset=utf-8');
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Retry-After: 140000'); // in seconds

require_once '../php/config.php';

?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/base.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?= URL_CSS ?>/skeleton.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <title>Interpreter Manager - Temporarily unavailable /  Temporairement indisponible</title>
    <body>
        <div class="container">
            <div>
                <i class="fa fa-hand-o-left fa-5x"></i>
            </div>
            <div>
                503
            </div>
            <div lang="en-CA">
                <div>
                    Interpreter Manager is under maintenance. Please check back later…
                    <br><br>
                    <span style="font-size: 0.7em;">
                        Seeing this page too frequently? <a href="mailto:vincent.diep61@gmail.com">Let us know</a>.
                    </span>
                </div>
            </div>
            <div lang="fr-CA">
                <div>
                    Nous effectuons la maintenance de Interpreter Manager. Veuillez réessayer plus tard…
                    <br><br>
                    <span style="font-size: 0.7em;">
                        Vous voyez cette page trop souvent? <a href="mailto:vincent.diep61@gmail.com ?>">Contactez-nous</a>.
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>