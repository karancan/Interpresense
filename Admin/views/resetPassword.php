<style>
    @import url('includes/css/login.css');
</style>
<form role="form" method="post" action="index.php?page=initiate-reset" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-refresh"></i> <?php $translate->_e('title'); ?></h4>
                </div>
                
                <div class="row">
                    <label class="sr-only" for="admin_username"><?php $translate->_e('usernamePlaceholder'); ?></label>
                    <input id="admin_username" name="username" type="text" class="form-control" placeholder="<?php echo $antiXSS->escape($translate->__('usernamePlaceholder'), $antiXSS::HTML_ATTR); ?>" required maxlength="255" pattern="\w+">
                </div>
                
                <br>
                
                <div class="row">
                    <label class="sr-only" for="admin_password"><?php $translate->_e('passwordPlaceholder'); ?></label>
                    <input id="admin_password" name="user_password" type="password" class="form-control" placeholder="<?php echo $antiXSS->escape($translate->__('passwordPlaceholder'), $antiXSS::HTML_ATTR); ?>" required>
                </div>
                
                <br>
                
                <div class="row">
                    <label class="sr-only" for="admin_password_2"><?php $translate->_e('password2Placeholder'); ?></label>
                    <input id="admin_password_2" type="password" class="form-control" placeholder="<?php echo $antiXSS->escape($translate->__('password2Placeholder'), $antiXSS::HTML_ATTR); ?>" required>
                </div>
                
            </div>
        
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3 admin-login-form-buttons">
                
                <div class="row">
                    
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> <?php $translate->_e('confirmBtn'); ?></button>
                    <a href="index.php" class="btn btn-warning pull-right"><i class="fa fa-angle-double-left"></i> <?php $translate->_e('cancelBtn'); ?></a>
                
                </div>
                
            </div>
            
        </div>
        
    </div>

</form>
<script>
    'use strict';
    
    $('.admin-login-form').submit(function(e) {
        if($('#admin_password').val() !== $('#admin_password_2').val()) {
            e.preventDefault();
            alert('<?php echo $antiXSS->escape($translate->__('passwordMismatchAlert'), $antiXSS::JS); ?>');
        }
    });
</script>