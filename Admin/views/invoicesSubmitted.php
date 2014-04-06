<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-folder-open"></i> Invoices Submitted</h3>
        </div>
        <div class="col-md-2">
            <a href="https://<?= URL_INTERPRESENSE ?>/ServiceProvider/" target="_blank" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add finalized invoice</a>        
        </div>
        <div class="col-md-2">
            <a href="invoicesSubmitted.php?page=export" class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export</a>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Existing submitted invoices</h4>
            
            <table class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>Column</th>
                        <th scope='col'>Column</th>
                        <th scope='col'>Column</th>
                        <th scope='col'>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
</div>