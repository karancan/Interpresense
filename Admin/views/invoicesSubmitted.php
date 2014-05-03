<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-folder-open"></i> Invoices Submitted</h3>
        </div>
        <div class="col-md-2">
            <a href="//<?= URL_INTERPRESENSE ?>/ServiceProvider/" target="_blank" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add finalized invoice</a>        
        </div>
        <div class="col-md-2">
            <a href="invoicesSubmitted.php?page=export&amp;start=<?= $filter_start_date->format('Y-m-d'); ?>&amp;end=<?= $filter_end_date->format('Y-m-d'); ?>" download class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export (CSV format)</a>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <!-- @todo: add datepickers to form inputs -->
            <form method="get" action="invoicesSubmitted.php">
                <h4>Finalized invoices added between 
                    <input id="interpresense_admin_invoices_submitted_start_date" name="start" class="admin-page-filter-input datepicker" type="text" value="<?= $filter_start_date->format('Y-m-d'); ?>"> and 
                    <input id="interpresense_admin_invoices_submitted_end_date" name="end" class="admin-page-filter-input datepicker" type="text" value="<?= $filter_end_date->format('Y-m-d'); ?>">
                    <img src="//<?= URL_IMAGES ?>/loader.gif" class="interpresense-loader">
                </h4>
            </form>
            
            <table class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Client</th>
                        <th scope='col'>Service provider</th>
                        <th scope='col'>Items</th>
                        <th scope='col'>Files</th>
                        <th scope='col'>Notes</th>
                        <th scope='col'>Total</th>
                        <th scope='col'>Approved</th>
                        <th scope='col'>Added</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if (empty($invoices)){
                            echo "<tr><td colspan='10' class='empty-table-placeholder'>No finalized invoices at this time…</td></tr>";
                        } else {
                            foreach($invoices as $i) {
                                echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     '<td class="table-option-cell">
                                      </td>' .
                                     '</tr>';
                            }
                        }
                        ?>
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