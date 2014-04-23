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
            
            <!-- @todo: add datepickers to form inputs -->
            <form method="get" action="invoicesSubmitted.php">
                <h4>Finalized invoices added between 
                    <input name="start" class="admin-page-filter-input" type="text" value="<?= (!empty($_GET['start']) ? $_GET['start'] : null) ?>"> and 
                    <input name="end" class="admin-page-filter-input" type="text" value="<?= (!empty($_GET['end']) ? $_GET['end'] : null) ?>">
                </h4>
            </form>
            
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
<script charset='utf-8' src='includes/js/admin.js'></script>