<style>
    @import url('includes/css/login.css');
</style>

<?php
if ($_GET['mode'] === 'login-failed'){
?>
<div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php $translate->_e('fail'); ?></strong> <?php $translate->_e('errorFail'); ?>
</div>
<?php } ?>

<?php
if ($_GET['mode'] === 'unconfirmed-user'){
?>
<div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php $translate->_e('fail'); ?></strong> <?php $translate->_e('errorUnconfirmed'); ?>
</div>

<?php } elseif ($_GET['mode'] === 'expired-user') { ?>

<div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php $translate->_e('fail'); ?></strong> <?php $translate->_e('errorExpired'); ?>
</div>
<?php } ?>

<form id="admin-log-in-form" role="form" method="post" action="index.php?page=attempt-login<?= (!empty($_GET['next']) ? '&amp;next=' . $antiXSS->escape($_GET['next'], $antiXSS::URL_PARAM) : null) ?>" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-lock"></i> &nbsp;<?php $translate->_e('title'); ?></h4>
                </div>
                
                <div class="row">
                    <div class="input-group">
                        <label for="admin_user_name" class="sr-only"><?php $translate->_e('usernamePlaceholder'); ?></label>
                        <input id="admin_user_name" name="user_name" type="text" class="form-control" placeholder="<?php echo $antiXSS->escape($translate->__('usernamePlaceholder'), $antiXSS::HTML_ATTR) ?>" required>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info" tabindex="-1"><?php $translate->_e('optionsBtn'); ?></button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRESENSE_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20New%20account%20request"><i class="fa fa-plus"></i> &nbsp; <?php $translate->_e('addNewUserItem'); ?></a></li>
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRESENSE_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20Forgot%20username"><i class="fa fa-refresh"></i> &nbsp; <?php $translate->_e('forgotUsernameItem'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <br>
                
                <div class="row">
                    <div class="input-group">
                        <label class="sr-only" for="admin_password"><?php $translate->_e('passwordPlaceholder'); ?></label>
                        <input id="admin_password" name="user_password" type="password" class="form-control" placeholder="<?php echo $antiXSS->escape($translate->__('passwordPlaceholder'), $antiXSS::HTML_ATTR); ?>" required>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info" tabindex="-1"><?php $translate->_e('optionsBtn'); ?></button>
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?page=reset-password"><i class="fa fa-refresh"></i> &nbsp; <?php $translate->_e('forgotPasswordItem'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3 admin-login-form-buttons">
                
                <div class="row">
                
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> <?php $translate->_e('submitBtn'); ?></button>
                
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