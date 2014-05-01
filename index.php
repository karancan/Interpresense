<?php
session_start();
require_once 'includes/php/config.php';
header('Content-Type: text/html; charset=utf-8');
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
    
    <style>
        video{
            width: 100%;
        }
        .jumbotron, footer{
            margin: 2em 0;
        }
        .interpresense-module-link{
            font-weight: bold;
        }
        .interpresense-objective{
            margin-top: 0;
        }
        .jumbotron h2{
            color: #7d7d7d;
        }
    </style>
    
    <script src='//<?= URL_VENDOR_FRONTEND ?>/jquery/dist/jquery.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/bootstrap/dist/js/bootstrap.min.js' charset='utf-8'></script>
    <script src='//<?= URL_VENDOR_FRONTEND ?>/DataTables/media/js/jquery.dataTables.js' charset='utf-8'></script>
    
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
                        <div class="jumbotron-photo">
                            <video>
                                <source src="movie.mp4" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                <!-- @todo: add video. If possible, add with custom play/pause controls for a better look. Font Awesome has video player icons -->
                            </video>
                        </div>
                        <div class="jumbotron-contents">
                            <h1 class="interpresense-objective">An invoicing solution built for organizations catering to clients with disabilities</h1>
                            <h2><i class="fa fa-fw fa-angle-double-right"></i>Modern and intuitive for <a class="interpresense-module-link" href="//<?= URL_SERVICE_PROVIDER ?>/">service providers</a></h2>
                            <p>Interpreters, note-takers and other service providers create, save and send invoices.</p>
                            <h2><i class="fa fa-fw fa-angle-double-right"></i>Powerful and flexible for <a class="interpresense-module-link" href="//<?= URL_ADMIN ?>/">administrators</a></h2>
                            <p>Administrators receive, approve and respond to invoices and generate reports and statistics in a few clicks.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="inset">
            
            <footer role='contentinfo'>
            
                <div class="row navbar-content">
                
                    <div class="col-md-8">
                        <img class="dev-logo" src="//<?= URL_IMAGES ?>/logo_icon_379_379.png">
                        Interpresense is brought to you by <a class="dev-social" href="http://ca.linkedin.com/pub/vincent-diep/47/847/5b9">Vincent Diep</a> &amp; <a class="dev-social" href="http://ca.linkedin.com/pub/karan-khiani/88/469/bab/">Karan Khiani</a>
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