<style>
    @import url('includes/css/setup.css');
</style>
<div class="container">

    <div class="row">
    
        <div class="col-md-12">
            <h4><i class="fa fa-users"></i> Add users</h4>
        </div>
        
    </div>
    
    <div class="row">
        
        <p class="col-md-12">A user must exist before the system can be used.</p>
        
    </div>
    
    <form action="index.php?page=go-to-step-4" method="POST" class="row">
        
        <div class="form-group col-md-12">
            <label class="control-label" for="username">Username</label>
            <input type="text" class="form-control" id="username">
        </div>

        <div class="form-group col-md-12">
            <label class="control-label" for="first_name">First name</label>
            <input type="text" class="form-control" id="first_name">
        </div>

        <div class="form-group col-md-12">
            <label class="control-label" for="last_name">Last name</label>
            <input type="text" class="form-control" id="last_name">
        </div>

        <div class="form-group col-md-12">
            <label class="control-label" for="expires_on">Expires on</label>
            <input type="text" class="form-control datepicker" id="expires_on">
        </div>
        
        <p class="col-md-12">More users can be added later on.</p>

        <div class="col-md-2">
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Save and proceed</button>
        </div>
        
    </form>
    
</div>