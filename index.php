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
        hr.inset {
            border: 0;
            height: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin: 1.5em 0 .25em;
        }
        .btn-redirect{
            margin-top: 25%;
        }
        h3{
            font-weight: normal;
            line-height: 1.5em;
            
        }
        .logo{
            width: 45%;
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
                    <img class="logo" src="//<?= URL_IMAGES ?>/logo_regular_1024_350.png" alt="Interpresense">
                </div>
                
                <div class="col-md-2">
                    <a href="//<?= URL_INTERPRESENSE ?>/ServiceProvider/" class="btn-redirect btn btn-block btn-info"><i class="fa fa-hand-o-right"></i> I am an interpreter</a>
                </div>
                
                <div class="col-md-2">
                    <a href="//<?= URL_INTERPRESENSE ?>/Admin/" class="btn-redirect btn btn-block btn-info"><i class="fa fa-hand-o-right"></i> I am an administrator</a>
                </div>
                
            </div>
            
            <hr class="inset">
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</h3>
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
            
            <div class="row">
                <div class="col-md-12">
                    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                </div>
            </div>
            
        </div>
    </body>
</html>