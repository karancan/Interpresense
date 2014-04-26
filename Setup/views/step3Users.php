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
                <input type="text" class="form-control" id="username" required>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name" required>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="last_name">Last name</label>
                <input type="text" class="form-control" id="last_name" required>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label" for="expires_on">Expires on</label>
                <input type="text" class="form-control datepicker" id="expires_on" required>
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
    
    //Init datepickers
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    
</script>