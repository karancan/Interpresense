<?php

header('Content-Type: text/html; charset=utf-8');
header('HTTP/1.1 404 Not Found');

require_once '../php/config.php';

?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>

    <link rel='shortcut icon' href='favicon.ico'>    
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR ?>/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR ?>/bootflat.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR ?>/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='//<?= URL_CSS ?>/interpresense.css'>
    
    <script src='//<?= URL_VENDOR ?>/jquery.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR ?>/jquery.dataTables.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR ?>/bootstrap/js/bootstrap.min.js' charset='utf-8'></script>
    
    <!--[if lt IE 9]>
    <script src='../includes/vendor/html5shiv/html5shiv-printshiv.js' charset='utf-8'></script>
    <![endif]-->

    <meta name='application-name' content='Interpresense'>
    <meta name='msapplication-tooltip' content='Interpresense'>
    <meta name='msapplication-starturl' content='<?= $_SERVER['REQUEST_URI'] ?>/'>    

    <title>Interpresense</title>
    <body>
        
        <div class="container">
        
            <div class="row">
                
                <div class="col-md-8">
                    <img class="external-page-logo" src="//<?= URL_IMAGES ?>/logo_regular_1024_350.png" alt="Interpresense">
                </div>
                
                <div class="col-md-2">
                    <a href="//<?= URL_INTERPRESENSE ?>/ServiceProvider/" class="external-page-btn-redirect btn btn-block btn-info"><i class="fa fa-hand-o-right"></i> I am an interpreter</a>
                </div>
                
                <div class="col-md-2">
                    <a href="//<?= URL_INTERPRESENSE ?>/Admin/" class="external-page-btn-redirect btn btn-block btn-info"><i class="fa fa-hand-o-right"></i> I am an administrator</a>
                </div>
                
            </div>
            
            <hr class="inset">
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="error-code"><i class="fa fa-frown-o fa-2x"></i><br>404</h1>
                </div>
            </div>

            <hr class="inset">
            
            <div class="row">
            
                <div class="col-md-8">
                    <?= date('Y') ?> &copy; Vincent Diep, Mr. Julian Huff &amp; Karan Khiani
                </div>
                
                <div class="col-md-2">
                    <a href="#" class="btn btn-block btn-info"><i class="fa fa-phone"></i> Get in touch</a>
                </div>
            
                <div class="col-md-2">
                    <a href="mailto:<?= EMAIL_INTERPRESENSE_ERROR_REPORTING ?>?subject=Interpresense%20bug%20report" class="btn btn-block btn-warning"><i class="fa fa-bug"></i> Report a bug</a>
                </div>
            
            </div>
            
        </div>
    </body>
</html>