<style>
    @import url('includes/css/login.css');
</style>

<?php
if ($_GET['mode'] === 'login-failed'){
?>
<div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Unsuccessful!</strong> That user name and password combination is invalid…
</div>
<?php } ?>

<?php
if ($_GET['mode'] === 'unconfirmed-user'){
?>
<div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Unsuccessful!</strong> Your account has not been activated yet…
</div>

<?php } elseif ($_GET['mode'] === 'expired-user') { ?>

<div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Unsuccessful!</strong> Your account has been expired…
</div>
<?php } ?>

<form id="admin-log-in-form" role="form" method="post" action="index.php?page=attempt-login<?= (!empty($_GET['next']) ? '&amp;next=' . $antiXSS->escape($_GET['next'], $antiXSS::URL_PARAM) : null) ?>" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-lock"></i> &nbsp;Please log in to continue…</h4>
                </div>
                
                <div class="row">
                    <div class="input-group">
                        <input id="admin_user_name" name="user_name" type="text" class="form-control" placeholder="Username" required>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info" tabindex="-1">Options</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRESENSE_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20New%20account%20request"><i class="fa fa-plus"></i> &nbsp; Add new user</a></li>
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRESENSE_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20Forgot%20username"><i class="fa fa-refresh"></i> &nbsp; Forgot username</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <br>
                
                <div class="row">
                    <div class="input-group">
                        <input id="admin_password" name="user_password" type="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info" tabindex="-1">Options</button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?page=reset-password"><i class="fa fa-refresh"></i> &nbsp; Forgot password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3 admin-login-form-buttons">
                
                <div class="row">
                
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Log me in</button>
                
                </div>
                
            </div>
            
        </div>
        
    </div>

</form>
<script>
    'use strict';
    
    //Input field for username should be automatically filled up
    if(localStorage.getItem('interpresense_user_username') !== null) {
        $('#admin_user_name').val(localStorage.getItem('interpresense_user_username'));
    }
    $('#admin_user_name').focus();
    
    //Save the user's user name in local storage
    $('#admin-log-in-form').submit(function(){
        localStorage.setItem('interpresense_user_username', $('#admin_user_name').val());
    });
</script>