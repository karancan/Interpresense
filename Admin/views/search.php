<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h3 class="admin-page-title"><i class="fa fa-search"></i> Results for <code><?= $_GET['q'] ?></code></h3>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <?php
            
            //The case where we have no matches whatsoever
            if (empty($finalInvoicesForClient) && empty($draftInvoicesForClient) && empty($finalInvoicesForSP) && empty($draftInvoicesForSP)){
                ?>
                
                <h4>No entries for <code> <?= $_GET['q'] ?> </code> have been found…</h4>
                <h6>We looked for finalized and draft invoices pertaining to clients and service providers.</h6>
                
                <?php
            }
            //We have some results in some form that have been returned
            else {
                //We have finalized invoice(s) pertaining to a client
                if (!empty($finalInvoicesForClient)){
                ?>
                
                <h4>Finalized invoices for client <code><?= $_GET['q'] ?></code></h4>
                
                <table class="table table-hover">           
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
                            foreach($finalInvoicesForClient as $i) {
                                echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                     "<td><strong>" . $i['client_id'] . "</strong></td>" .
                                     "<td>" . $i['sp_name'] . "</td>" .
                                     "<td>" . $i['item_count'] . "</td>" .
                                     "<td>" . $i['file_count'] . "</td>" .
                                     "<td>" . $i['note_count'] . "</td>" .
                                     "<td>" . $i['grand_total'] . "</td>" .
                                     "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                     "<td>" . $dateFmt->format($r['inserted_on'], 'date_time') . "</td>" .
                                     "<td>" . //Link to invoice on the invoices page w/ focus
                                     "</td>" .
                                     "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                
                <?php
                }
                //We have draft invoice(s) pertaining to a client
                if (!empty($draftInvoicesForClient)){
                ?>
                
                <h4>Draft invoices for client <code><?= $_GET['q'] ?></code></h4>
                
                <table class="table table-hover">           
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
                            foreach($draftInvoicesForClient as $i) {
                                echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                     "<td><strong>" . $i['client_id'] . "</strong></td>" .
                                     "<td>" . $i['sp_name'] . "</td>" .
                                     "<td>" . $i['item_count'] . "</td>" .
                                     "<td>" . $i['file_count'] . "</td>" .
                                     "<td>" . $i['note_count'] . "</td>" .
                                     "<td>" . $i['grand_total'] . "</td>" .
                                     "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                     "<td>" . $dateFmt->format($r['inserted_on'], 'date_time') . "</td>" .
                                     "<td>" . //Link to invoice on the invoices page w/ focus
                                     "</td>" .
                                     "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                
                <?php
                }
                //We have finalized invoice(s) pertaining to a service provider
                if (!empty($finalInvoicesForSP)){
                ?>
                
                <h4>Finalized invoices for service provider <code><?= $_GET['q'] ?></code></h4>
                
                <table class="table table-hover">           
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
                            foreach($finalInvoicesForSP as $i) {
                                echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                     "<td>" . $i['client_id'] . "</td>" .
                                     "<td><strong>" . $i['sp_name'] . "</strong></td>" .
                                     "<td>" . $i['item_count'] . "</td>" .
                                     "<td>" . $i['file_count'] . "</td>" .
                                     "<td>" . $i['note_count'] . "</td>" .
                                     "<td>" . $i['grand_total'] . "</td>" .
                                     "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                     "<td>" . $dateFmt->format($r['inserted_on'], 'date_time') . "</td>" .
                                     "<td>" . //Link to invoice on the invoices page w/ focus
                                     "</td>" .
                                     "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                
                <?php
                }
                //We have draft invoice(s) pertaining to a service provider
                if (!empty($draftInvoicesForSP)){
                ?>
                
                <h4>Draft invoices for service provider <code><?= $_GET['q'] ?></code></h4>
                
                <table class="table table-hover">           
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
                            foreach($draftInvoicesForSP as $i) {
                                echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                     "<td>" . $i['client_id'] . "</td>" .
                                     "<td><strong>" . $i['sp_name'] . "</strong></td>" .
                                     "<td>" . $i['item_count'] . "</td>" .
                                     "<td>" . $i['file_count'] . "</td>" .
                                     "<td>" . $i['note_count'] . "</td>" .
                                     "<td>" . $i['grand_total'] . "</td>" .
                                     "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                     "<td>" . $dateFmt->format($r['inserted_on'], 'date_time') . "</td>" .
                                     "<td>" . //Link to invoice on the invoices page w/ focus
                                     "</td>" .
                                     "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                
                <?php
                }
            }
            ?>
        
        </div>
        
    </div>
    
</div>