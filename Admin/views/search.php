<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h3 class="admin-page-title"><i class="fa fa-search"></i> Results for <code><?= $antiXSS->escape($_GET['q']) ?></code></h3>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <?php
            
            //The case where we have no matches whatsoever
            if (empty($finalInvoicesForClient) && empty($draftInvoicesForClient) && empty($finalInvoicesForSP) && empty($draftInvoicesForSP)){
                ?>
                
                <h4>No entries for <code> <?= $antiXSS->escape($_GET['q']) ?> </code> have been found…</h4>
                <h6>We looked for finalized and draft invoices pertaining to clients and service providers.</h6>
                
                <?php
            }
            //We have some results in some form that have been returned
            else {
                //We have finalized invoice(s) pertaining to a client
                if (!empty($finalInvoicesForClient)){
                ?>
                
                <h4>Finalized invoices for client <code><?= $antiXSS->escape($_GET['q']) ?></code></h4>
                
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
                        <?php
                        foreach($finalInvoicesForClient as $i) {
                            $invoiceDate = date('Y-m-d', strtotime($i['inserted_on']));
                            echo "<tr>" .
                                 "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                 "<td><strong>" . $i['client_id'] . "</strong></td>" .
                                 "<td>" . $i['sp_name'] . "</td>" .
                                 "<td>" . $numFmt->format($i['item_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['file_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['note_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['grand_total'], 'currency') . "</td>" .
                                 "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                 "<td>" . $dateFmt->format($i['inserted_on'], 'date_time') . "</td>" .
                                 "<td class='table-option-cell'>" .
                                     '<a href="invoicesSubmitted.php?focus=' . $antiXSS->escape($i['invoice_id'], $antiXSS::URL_PARAM) . '&amp;start=' . $invoiceDate . '&amp;end=' . $invoiceDate . '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View</a>' .
                                 "</td>" .
                                 "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <?php
                }
                //We have draft invoice(s) pertaining to a client
                if (!empty($draftInvoicesForClient)){
                ?>
                
                <h4>Draft invoices for client <code><?= $antiXSS->escape($_GET['q']) ?></code></h4>
                
                <table class="table table-hover">           
                    <thead>
                        <tr>
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
                        <?php
                        foreach($draftInvoicesForClient as $i) {
                            $invoiceDate = date('Y-m-d', strtotime($i['inserted_on']));
                            echo "<tr>" .
                                 "<td><strong>" . $i['client_id'] . "</strong></td>" .
                                 "<td>" . $i['sp_name'] . "</td>" .
                                 "<td>" . $numFmt->format($i['item_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['file_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['note_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['grand_total'], 'currency') . "</td>" .
                                 "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                 "<td>" . $dateFmt->format($i['inserted_on'], 'date_time') . "</td>" .
                                 "<td class='table-option-cell'>" .
                                     '<a href="invoicesDrafts.php?focus=' . $antiXSS->escape($i['invoice_id'], $antiXSS::URL_PARAM) . '&amp;start=' . $invoiceDate . '&amp;end=' . $invoiceDate . '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View</a>' .
                                 "</td>" .
                                 "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <?php
                }
                //We have finalized invoice(s) pertaining to a service provider
                if (!empty($finalInvoicesForSP)){
                ?>
                
                <h4>Finalized invoices for service provider <code><?= $antiXSS->escape($_GET['q']) ?></code></h4>
                
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
                        <?php
                        foreach($finalInvoicesForSP as $i) {
                            $invoiceDate = date('Y-m-d', strtotime($i['inserted_on']));
                            echo "<tr>" .
                                 "<td>" . $i['invoice_id_for_org'] . "</td>" .
                                 "<td>" . $i['client_id'] . "</td>" .
                                 "<td><strong>" . $i['sp_name'] . "</strong></td>" .
                                 "<td>" . $numFmt->format($i['item_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['file_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['note_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['grand_total'], 'currency') . "</td>" .
                                 "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                 "<td>" . $dateFmt->format($i['inserted_on'], 'date_time') . "</td>" .
                                 "<td class='table-option-cell'>" .
                                     '<a href="invoicesSubmitted.php?focus=' . $antiXSS->escape($i['invoice_id'], $antiXSS::URL_PARAM) . '&amp;start=' . $invoiceDate . '&amp;end=' . $invoiceDate . '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View</a>' .
                                 "</td>" .
                                 "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <?php
                }
                //We have draft invoice(s) pertaining to a service provider
                if (!empty($draftInvoicesForSP)){
                ?>
                
                <h4>Draft invoices for service provider <code><?= $antiXSS->escape($_GET['q']) ?></code></h4>
                
                <table class="table table-hover">           
                    <thead>
                        <tr>
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
                        <?php
                        foreach($draftInvoicesForSP as $i) {
                            $invoiceDate = date('Y-m-d', strtotime($i['inserted_on']));
                            echo "<tr>" .
                                 "<td>" . $i['client_id'] . "</td>" .
                                 "<td><strong>" . $i['sp_name'] . "</strong></td>" .
                                 "<td>" . $numFmt->format($i['item_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['file_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['note_count'], 'decimal') . "</td>" .
                                 "<td>" . $numFmt->format($i['grand_total'], 'currency') . "</td>" .
                                 "<td>" . ($i['is_approved'] ? 'Yes' : 'No') . "</td>" .
                                 "<td>" . $dateFmt->format($i['inserted_on'], 'date_time') . "</td>" .
                                 "<td class='table-option-cell'>" .
                                     '<a href="invoicesDrafts.php?focus=' . $antiXSS->escape($i['invoice_id'], $antiXSS::URL_PARAM) . '&amp;start=' . $invoiceDate . '&amp;end=' . $invoiceDate . '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View</a>' .
                                 "</td>" .
                                 "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <?php
                }
            }
            ?>
        
        </div>
        
    </div>
    
</div>