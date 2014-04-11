<style>
    @import url('includes/css/login.css');
</style>
<form role="form" method="post" action="index.php?page=attempt-login<?= (!empty($_GET['next']) ? '&amp;next=' . $antiXSS->escape($_GET['next'], $antiXSS::URL_PARAM) : null) ?>" class="admin-login-form">

    <div class="container">
        
        <div class="row">
        
            <div class="col-md-6 col-md-offset-3 admin-login-form-inputs">
                
                <div class="row">
                    <h4><i class="fa fa-lock"></i> &nbsp;Please log in to continue...</h4>
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
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRETER_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20New%20account%20request"><i class="fa fa-plus"></i> &nbsp; Add new user</a></li>
                                <li><a href="mailto:<?= EMAIL_ALIAS_INTERPRETER_COORDINATOR . EMAIL_ORG_STAFF_DOMAIN ?>?subject=Interpresense:%20Forgot%20username"><i class="fa fa-refresh"></i> &nbsp; Forgot username</a></li>
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
                                <li><a href="index.php?page=register-or-reset"><i class="fa fa-refresh"></i> &nbsp; Forgot password</a></li>
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