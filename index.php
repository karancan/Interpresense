<?php
require_once 'includes/php/config.php';
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>

    <link rel='shortcut icon' href='favicon.ico'>    
    <link rel='stylesheet' media='screen' type='text/css' href='includes/vendor/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' media='screen' type='text/css' href='includes/vendor/bootflat.min.css'>
    <link rel='stylesheet' href='includes/vendor/fontawesome/css/font-awesome.min.css'>
    <link rel='stylesheet' href='includes/css/interpresense.css'>
    
    <style>
        hr.inset {
            border: 0;
            height: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin: 4em 0;
        }
        .btn-redirect{
            font-size: 2em;
        }
        h3{
            font-weight: normal;
            line-height: 1.5em;
            margin-bottom: 0;
        }
        .logo{
            width: 75%;
        }
    </style>
    
    <script src='includes/vendor/jquery.min.js' charset='utf-8'></script>
    <script src='includes/vendor/jquery.dataTables.min.js' charset='utf-8'></script>
    <script src='includes/vendor/bootstrap/js/bootstrap.min.js' charset='utf-8'></script>
    
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
                <div class="col-md-12 text-center">
                    <img class="logo" src="includes/img/logo_regular_1024_350.png" alt="Interpresense">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</h3>
                </div>
            </div>
            
            <hr class="inset">
            
            <div class="row">
                
                <div class="col-md-4 col-md-offset-1 text-center">
                    <p><i class="fa fa-user fa-5x"></i></p>
                    <a href="//<?= URL_INTERPRESENSE ?>/ServiceProvider/" class="btn-redirect btn btn-block btn-info btn-lg">I am an interpreter</a>
                </div>
                
                <div class="col-md-4 col-md-offset-2 text-center">
                    <p><i class="fa fa-users fa-5x"></i></p>
                    <a href="//<?= URL_INTERPRESENSE ?>/Admin/" class="btn-redirect btn btn-block btn-info btn-lg">I am an administrator</a>
                </div>
                
            </div>
            
            <hr class="inset">
            
            <div class="row">
                <p><small>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</small></p>
            </div>
            
        </div>
    </body>
</html>