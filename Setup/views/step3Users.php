<style>
    @import url('includes/css/setup.css');
</style>
<div class="container">

    <div class="row">
    
        <div class="col-md-12">
            <h4><i class="fa fa-users"></i> Add an administrative user</h4>
        </div>
        
    </div>
    
    <div class="row">
        <p class="col-md-12">At least one administrative user must exist before the application can be used. More users can be added later on…</p>
    </div>
    
    <form action="index.php?page=go-to-step-4" method="POST" class="col-md-12">
            
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="username">Username</label>
                <input type="text" class="form-control" name="user_name" id="username" required maxlength="255" pattern="\w+">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="first_name">First name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" required maxlength="255" pattern="[\w .'-]+">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="last_name">Last name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" required maxlength="255" pattern="[\w .'-]+">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="expires_on">Expires on</label>
                <input type="text" class="form-control datepicker" name="expires_on" id="expires_on" required maxlength="10">
            </div>
        </div>
            

        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save and proceed</button>
            </div>
        </div>
        
    </form>
    
</div>
<script>
    'use strict';
    
    //Init datepickers
    $('#expires_on').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date()
    });
    
</script>