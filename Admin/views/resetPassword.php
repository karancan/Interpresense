<style>
    @import url('includes/css/login.css');
</style>
<form role="form" method="post" action="index.php?page=initiate-reset" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-refresh"></i> &nbsp;Reset your password...</h4>
                </div>
                
                <div class="row">
                    <input id="admin_username" name="username" type="text" class="form-control" placeholder="Username" required maxlength="255" pattern="\w+">
                </div>
                
                <br>
                
                <div class="row">
                    <input id="admin_password" name="user_password" type="password" class="form-control" placeholder="Password" required>
                </div>
                
                <br>
                
                <div class="row">
                    <input id="admin_password_2" type="password" class="form-control" placeholder="Re-enter password" required>
                </div>
                
            </div>
        
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3 admin-login-form-buttons">
                
                <div class="row">
                    
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm password reset</button>
                    <a href="index.php" class="btn btn-warning pull-right"><i class="fa fa-angle-double-left"></i> Return to log in</a>
                
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
        }
    });
</script>