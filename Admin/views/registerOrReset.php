<style>
    @import url('includes/css/login.css');
</style>
<form role="form" method="post" action="invoicesExpected.php" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-refresh"></i> &nbsp;Reset your password...</h4>
                </div>
                
                <div class="row">
                    <input id="admin_username" type="text" class="form-control" placeholder="Username">
                </div>
                
                <br>
                
                <div class="row">
                    <input id="admin_password" type="password" class="form-control" placeholder="Password">
                </div>
                
                <br>
                
                <div class="row">
                    <input id="admin_password_2" type="password" class="form-control" placeholder="Re-enter password">
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