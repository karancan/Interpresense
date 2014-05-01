<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
header('HTTP/1.1 404 Not Found');

require_once '../php/config.php';

?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>

    <link rel='shortcut icon' href='favicon.ico'>
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR_FRONTEND ?>/bootstrap/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='//<?= URL_VENDOR_FRONTEND ?>/Bootflat/bootflat/css/bootflat.min.css'>
    <link rel='stylesheet' href='//<?= URL_VENDOR_FRONTEND ?>/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='//<?= URL_CSS ?>/interpresense.css'>
    
    <script src='//<?= URL_VENDOR_FRONTEND ?>/jquery/dist/jquery.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/bootstrap/dist/js/bootstrap.min.js' charset='utf-8'></script>
    
    <!--[if lt IE 9]>
    <script src='../includes/vendor/html5shiv/html5shiv-printshiv.js' charset='utf-8'></script>
    <![endif]-->

    <meta name='application-name' content='Interpresense'>
    <meta name='msapplication-tooltip' content='Interpresense'>
    <meta name='msapplication-starturl' content='<?= $_SERVER['REQUEST_URI'] ?>/'>    

    <title>Interpresense</title>
    <body>
        
        <div class="container">
        
            <header class="external-page-header">
            
                <div class="row">
                    <div class="col-md-8">
                        <a href="//<?= URL_INTERPRESENSE ?>/">
                            <img class="external-page-logo" src="//<?= URL_IMAGES ?>/logo_regular_1024_350.png" alt="Interpresense">
                        </a>
                    </div>
                    <div class="col-md-2 pull-right">
                        <div class="btn-group header-options-container pull-right">
                            <button type="button" class="btn btn-info"><i class="fa fa-font"></i> Language</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="//<?= URL_PHP ?>/lang.php?lang=en-CA">English <?= ($_SESSION['lang'] === 'en-CA' ? '<i class="fa fa-check"></i>' : null)?></a></li>
                                <li><a href="//<?= URL_PHP ?>/lang.php?lang=fr-CA">Français <?= ($_SESSION['lang'] === 'fr-CA' ? '<i class="fa fa-check"></i>' : null)?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            
            </header>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <div class="jumbotron-photo error-code-container">
                            <h1 class="error-code text-center"><i class="fa fa-thumbs-o-down"></i> 404</h1>
                        </div>
                        <div class="jumbotron-contents">
                            <h1 class="error-description">The page you are looking for doesn't exist…</h1>
                            <h2>I am a <a class="interpresense-module-link" href="//<?= URL_SERVICE_PROVIDER ?>/">service provider</a> looking to fill out an invoice</h2>
                            <h2>I am an <a class="interpresense-module-link" href="//<?= URL_ADMIN ?>/">administrator</a> looking to review invoices and generate reports</h2>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="inset">
            
            <footer role='contentinfo'>
            
                <div class="row navbar-content">
                
                    <div class="col-md-8">
                        <img class="dev-logo" src="//<?= URL_IMAGES ?>/logo_icon_379_379.png">
                        Powered by Interpresense
                    </div>
                    
                    <div class="col-md-2">
                        <a href="mailto:<?= EMAIL_INTERPRESENSE_REPORTING ?>?subject=Interpresense%20query" class="btn btn-block btn-info"><i class="fa fa-phone"></i> Get in touch</a>
                    </div>
                
                    <div class="col-md-2">
                        <a href="mailto:<?= EMAIL_INTERPRESENSE_REPORTING ?>?subject=Interpresense%20bug%20report" class="btn btn-block btn-warning"><i class="fa fa-bug"></i> Report a bug</a>
                    </div>
                
                </div>
            
            </footer>
            
        </div>
    </body>
</html>