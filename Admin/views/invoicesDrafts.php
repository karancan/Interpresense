<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-folder-open"></i> Invoice Drafts</h3>
        </div>
        <div class="col-md-2">
            <a href="https://<?= URL_INTERPRESENSE ?>/ServiceProvider/" target="_blank" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add draft invoice</a>        
        </div>
        <div class="col-md-2">
            <a href="invoicesDrafts.php?page=export&start=<?= $antiXSS->escape($filter_start_date, $antiXSS::URL_PARAM) ?>&end=<?= $antiXSS->escape($filter_end_date, $antiXSS::URL_PARAM) ?>" class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export (CSV format)</a>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-12">
            
            <!-- @todo: add datepickers to form inputs -->
            <form method="get" action="invoicesDrafts.php">
                <h4>Draft invoices added between 
                    <input id="interpresense_admin_invoices_drafts_start_date" name="start" class="admin-page-filter-input datepicker" type="text" value="<?= $antiXSS->escape($filter_start_date, $antiXSS::HTML_ATTR) ?>"> and 
                    <input id="interpresense_admin_invoices_drafts_end_date" name="end" class="admin-page-filter-input datepicker" type="text" value="<?= $antiXSS->escape($filter_end_date, $antiXSS::HTML_ATTR) ?>">
                    <img src="//<?= URL_IMAGES ?>/loader.gif" class="interpresense-loader">
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
<script>
    
    //Init datepickers
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    
</script>