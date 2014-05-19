<div class="modal" id="admin-invoice-items-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-items-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center modal-wide">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Invoice items</h4>
            </div>

            <div class="modal-body">
                
                <div class="row text-center">
                    <img id="admin-invoice-items-loader" src="//<?= URL_IMAGES ?>/loader.gif" class="center-block interpresense-loader">            
                </div>
                
                <p id="admin-invoice-viewed-container">
                    <span id="admin-invoice-last-viewed"></span>
                    <a id="admin-invoice-mark-as-unread"> Mark as unread</a>
                </p>
                
                <table id="admin-invoice-items-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope='col'>Added on</th>
                            <th scope='col'>Activity</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Course</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Start time</th>
                            <th scope='col'>End time</th>
                            <th scope='col'>Rate ($/h)</th>
                            <th scope='col'><strong>Total ($)</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                
            </div>
            
            <div class="modal-footer">
                <p id="admin-invoice-grand-total-container">Grand total <strong>$<span id="admin-invoice-grand-total"></span></strong></p>
            </div>
            
        </div>
    </div>
</div>

<div class="modal" id="admin-invoice-files-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-files-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Invoice files</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="row text-center">
                    <img id="admin-invoice-files-loader" src="//<?= URL_IMAGES ?>/loader.gif" class="center-block interpresense-loader">            
                </div>
                
                <table id="admin-invoice-files-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope='col'>File</th>
                            <th scope='col'>Added on</th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>

<div class="modal" id="admin-invoice-notes-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-notes-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center modal-wide">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Invoice notes</h4>
            </div>
            
            <div class="modal-body">
                
                <div class="row text-center">
                    <img id="admin-invoice-notes-loader" src="//<?= URL_IMAGES ?>/loader.gif" class="interpresense-loader">
                </div>
                
                <table id="admin-invoice-notes-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope='col' style='width: 20%;'>User</th>
                            <th scope='col'>Note</th>
                            <th scope='col' style='width: 20%;'>Added on</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>

<div class="modal" id="admin-invoice-add-notes-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-add-notes-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form id="admin-invoice-add-notes-form" action="<?= basename($_SERVER["SCRIPT_FILENAME"]) ?>?page=add-note" method="POST" class="modal-content">
            
            <input type="hidden" name="invoice_id" value="">
            <input type="hidden" name="date-filter-start" value="">
            <input type="hidden" name="date-filter-end" value="">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add a note</h4>
            </div>
            
            <div class="modal-body">
                
                <p>This note will not be shown to the service provider</p>
                
                <textarea class="form-control" id="invoice_note" name="note" rows="10" required></textarea>
                
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>

<div class="modal" id="admin-invoice-sp-details-modal" tabindex="-1" role="dialog" aria-labelledby="admin-invoice-sp-details-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Service provider</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <p id="invoice_sp_name"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Phone</label>
                    <p id="invoice_sp_phone"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <p id="invoice_sp_email"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Address</label>
                    <p id="invoice_sp_address"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Postal code</label>
                    <p id="invoice_sp_postal_code"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">City and province</label>
                    <p id="invoice_sp_city_province"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label">HST number</label>
                    <p id="invoice_sp_hst_number"></p>
                </div>
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>