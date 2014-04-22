<style>
    @import url('includes/css/setup.css');
</style>

<?php
if ($_GET['mode'] === 'fail'){
?>
<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Unsuccessful!</strong> <?= urldecode($_GET['reason'])?>
</div>
<?php } ?>

<div class="container">
    
    <div class="row">
    
        <div class="col-md-12">
            <h4><i class="fa fa-hdd-o"></i> Setting up the database</h4>
        </div>
        
    </div>
    
    <div class="row">
    
        <div class="col-md-12">
            
            <h5 class="setup-step-description">These steps will allow us to create a database that stores all the data that is generated in this application.</h5>
            
            <div class="setup-step-container">
            
                <ol>
                    <li>On the server that contains this application, navigate inside the Interpresense folder to <code>includes/php/</code>
                    <li>Open the file <code>config-sample.php</code> in a text editor
                    <li>Fill in the following values:
                        <ul>
                            <li><code>DB_HOSTNAME</code></li>
                            <li><code>DB_USERNAME</code></li>
                            <li><code>DB_PASSWORD</code></li>
                            <li><code>DB_NAME</code></li>
                        </ul>
                    </li>
                    <li>Save these changes <strong>as a new file</strong> called <code>config.php</code>
                </ol>
            
            </div>
            
        </div>
        
    </div>
    
    <div class="row">
    
        <div class="col-md-3">
            <a href="index.php?page=go-to-step-2" class="btn btn-success btn-block"><i class="fa fa-check"></i> Test connection and proceed</a>
        </div>
    
    </div>
    
</div>