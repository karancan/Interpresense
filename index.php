<?php
require_once 'includes/php/config.php';
header('Content-Type: text/html; charset=utf-8');
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
    
    <style>
        h3{
            font-weight: normal;
            line-height: 1.5em;
            margin-top: 0;
        }
        video{
            width: 100%;
            margin: 1em 0;
        }
    </style>
    
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
                    <h3>Modern and intuitive for service providers. Powerful and flexible for administrators.</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <video>
                        <source src="movie.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                    </video>
                </div>
            </div>

            <hr class="inset">
            
            <footer role='contentinfo'>
            
                <div class="row navbar-content">
                
                    <div class="col-md-8">
                        <?= date('Y') ?> &copy; Interpresense by Vincent Diep &amp; Karan Khiani
                    </div>
                    
                    <div class="col-md-2">
                        <a href="#" class="btn btn-block btn-info"><i class="fa fa-phone"></i> Get in touch</a>
                    </div>
                
                    <div class="col-md-2">
                        <a href="mailto:<?= EMAIL_INTERPRESENSE_ERROR_REPORTING ?>?subject=Interpresense%20bug%20report" class="btn btn-block btn-warning"><i class="fa fa-bug"></i> Report a bug</a>
                    </div>
                
                </div>
            
            </footer>
            
        </div>
    </body>
</html>