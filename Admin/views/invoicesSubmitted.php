<style>
    @import url('//<?= URL_VENDOR_FRONTEND ?>/datatables-bootstrap3/BS3/assets/css/datatables.css');
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
            <a href="invoicesSubmitted.php?page=export&amp;start=<?= $filter_start_date->format('Y-m-d'); ?>&amp;end=<?= $filter_end_date->format('Y-m-d'); ?>&amp;approved_only=<?= $antiXSS->escape($_GET['approved_only'], $antiXSS::URL_PARAM); ?>" download target="_blank" class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export (CSV format)</a>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <form method="get" action="invoicesSubmitted.php">
                <h4>Finalized invoices added between 
                    <input id="interpresense_admin_invoices_submitted_start_date" name="start" class="admin-page-filter-input datepicker" type="text" value="<?= $filter_start_date->format('Y-m-d'); ?>"> and 
                    <input id="interpresense_admin_invoices_submitted_end_date" name="end" class="admin-page-filter-input datepicker" type="text" value="<?= $filter_end_date->format('Y-m-d'); ?>">
                    <?php include 'views/dateRangeQuickPicks.php'; ?>
                    <img src="//<?= URL_IMAGES ?>/loader.gif" class="interpresense-loader">
                </h4>
            </form>
            
            <div class="admin-filter-approved-invoices-container">
                <label for="admin-filter-approved-invoices">
                    <input type="checkbox" id="admin-filter-approved-invoices" <?= ($_GET['approved_only'] === "1" ? 'checked' : null) ?>>
                    View approved invoices only
                </label>
            </div>
                
            <table id="admin-invoices-submitted-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Client</th>
                        <th scope='col'>Service provider</th>
                        <th scope='col'>Items</th>
                        <th scope='col'>Files</th>
                        <th scope='col'>Notes</th>
                        <th scope='col'>Total ($)</th>
                        <th scope='col'>Approved</th>
                        <th scope='col'>Added</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($invoices)){
                        foreach($invoices as $i) {
                            echo "<tr data-invoice-id='{$antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR)}'
                                      data-sp-name='{$antiXSS->escape($i['sp_name'], $antiXSS::HTML_ATTR)}'
                                      data-sp-address='{$antiXSS->escape($i['sp_address'], $antiXSS::HTML_ATTR)}'
                                      data-sp-postal-code='{$antiXSS->escape($i['sp_postal_code'], $antiXSS::HTML_ATTR)}'
                                      data-sp-city='{$antiXSS->escape($i['sp_city'], $antiXSS::HTML_ATTR)}'
                                      data-sp-province='{$antiXSS->escape($i['sp_province'], $antiXSS::HTML_ATTR)}'
                                      data-sp-phone='{$antiXSS->escape($i['sp_phone'], $antiXSS::HTML_ATTR)}'
                                      data-sp-email='{$antiXSS->escape($i['sp_email'], $antiXSS::HTML_ATTR)}'
                                      data-sp-hst-number='{$antiXSS->escape($i['sp_hst_number'], $antiXSS::HTML_ATTR)}'>" .
                                 "<td>" . "<i class='fa fa-edit' data-action='edit-invoice-id-for-org'></i>" . "<span id='admin-invoice-id-for-org-" . $antiXSS->escape($i['invoice_id'], $antiXSS::HTML_ATTR) . "'>" . (empty($i['invoice_id_for_org']) ? 'N/A' : $i['invoice_id_for_org']) . "</span>" . "</td>" .
                                 "<td>" . $i['client_id'] . "</td>" .
                                 "<td>" . "<a href='#admin-invoice-sp-details-modal' data-toggle='modal' data-action='view-sp-details' class='admin-modal-links'>" . $i['sp_name'] . "</a>" . "</td>" .
                                 "<td>" . "<a href='#admin-invoice-items-modal' data-toggle='modal' data-action='view-items' class='admin-modal-links'>" . $numFmt->format($i['item_count'], 'decimal') . "</a>" . "</td>" .
                                 "<td>" . "<a href='#admin-invoice-files-modal' data-toggle='modal' data-action='view-files' class='admin-modal-links'>" . $numFmt->format($i['file_count'], 'decimal') . "</a>" . "</td>" .
                                 "<td>" . "<a href='#admin-invoice-notes-modal' data-toggle='modal' data-action='view-notes' class='admin-modal-links'>" . $numFmt->format($i['note_count'], 'decimal') . "</a>" . "</td>" .
                                 "<td>" . $numFmt->format($i['grand_total'], 'currency') . "</td>" .
                                 "<td>" . ($i['is_approved'] ? '<span class="admin-invoice-approved-details" data-content="Approved on ' . $dateFmt->format($i['approved_on'], 'date_time') . ' by ' . $i['first_name'] . ' ' . $i['last_name'] . '">Yes</span>' : 'No') . "</td>" .
                                 "<td>" . $dateFmt->format($i['inserted_on'], 'date_time') . "</td>" .
                                 '<td class="table-option-cell">' .
                                     (!$i['is_approved'] ? '<button type="button" class="btn btn-success" data-action="approve-invoice"><i class="fa fa-check-square-o"></i> Approve</button>' : null) .
                                     (!$i['is_approved'] ? '<button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-invoice-mark-as-draft-modal" data-action="mark-as-draft"><i class="fa fa-thumbs-down"></i> Mark as draft</button>' : null) .
                                     '<button type="button" class="btn btn-info" data-toggle="modal" href="#admin-invoice-add-notes-modal" data-action="add-note"><i class="fa fa-plus"></i> Add note</button>
                                  </td>' .
                                 '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
</div>
<div class="modal" id="admin-invoice-mark-as-draft-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-mark-as-draft-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form id="admin-invoice-mark-as-draft-form" action="invoicesSubmitted.php?page=mark-invoice-as-draft" method="POST" class="modal-content">
            
            <input type="hidden" name="invoice_id" value="">
            <input type="hidden" name="start" value="<?= $antiXSS->escape($_GET['start'], $antiXSS::HTML_ATTR) ?>">
            <input type="hidden" name="end" value="<?= $antiXSS->escape($_GET['end'], $antiXSS::HTML_ATTR) ?>">
            <input type="hidden" name="approved_only" value="<?= $antiXSS->escape($_GET['approved_only'], $antiXSS::HTML_ATTR) ?>">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Change invoice to draft status</h4>
            </div>
            
            <div class="modal-body">
                
                <p>Why is this invoice being changed to draft status?</p>
                <p><small>(This note will be shown to the service provider)</small></p>
                
                <textarea class="form-control" id="invoice_note_mark_as_draft" name="note" rows="10" required></textarea>
                
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>
<?php require FS_ADMIN . '/views/invoicesModals.php'; ?>
<script charset='utf-8' src='//<?= URL_VENDOR_FRONTEND ?>/datatables-bootstrap3/BS3/assets/js/datatables.js'></script>
<script charset='utf-8' src='includes/js/admin.js'></script>
<script charset='utf-8' src='includes/js/invoices.js'></script>
<script charset='utf-8' src='includes/js/invoicesSubmitted.js'></script>
<script charset='utf-8' src='includes/js/dateRangeQuickPicks.js'></script>
<script>
    'use strict';
    var focus = '<?= $antiXSS->escape($_GET['focus'], $antiXSS::JS) ?>';
</script>