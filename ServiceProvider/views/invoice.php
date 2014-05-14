<style>
    @import url('includes/css/serviceProvider.css');
</style>
<div class="container">
    
    <div class="row">
        
        <div class="col-md-12">
            <div class="well invoice-instructions">
                <h3 class="page-title"><i class="fa fa-info-circle"></i> Invoicing instructions</h3>
                <ul>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                <ul>
            </div>
        </div>
        
    </div>
    
    <form method="post" action="index.php?page=invoice-submission" id='invoice_form' enctype='multipart/form-data'>
        
        <div class="row">
            <section class="col-md-3" id='invoice_from'>
                
                <h3>From</h3>
                
                <div class='form-group'>
                    <label for="sp_name" class="sr-only">Name</label>
                    <input type="text" class="form-control input-top" placeholder="Name" name="sp_name" id="sp_name" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_address" class="sr-only">Address</label>
                    <input type="text" class="form-control input-center" placeholder="Address" name="sp_address" id="sp_address" maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_city" class="sr-only">City</label>
                    <input type="text" class="form-control input-center" placeholder="City" name="sp_city" id="sp_city" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_province" class="sr-only">Province</label>
                    <select class="form-control input-center" name="sp_province" id="sp_province" required>
                        <option value="">Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Bruswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="NU">Nunavut</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="PQ">Québec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="YT">Yukon Territory</option>
                    </select>
                </div>
                
                <div class='form-group'>
                    <label for="sp_postal_code" class="sr-only">Postal code</label>
                    <input type="text" class="form-control input-center" placeholder="Postal code" name="sp_postal_code" id="sp_postal_code" required pattern="^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]\d[ABCEGHJKLMNPRSTVWXYZ]\d$" maxlength="6">
                </div>
                
                <div class='form-group'>
                    <label for="sp_phone" class="sr-only">Phone number</label>
                    <input type="tel" class="form-control input-center" placeholder="Phone number" name="sp_phone" id="sp_phone" required pattern='\d+' maxlength="10">
                </div>
                
                <div class='form-group'>
                    <label for="sp_email" class="sr-only">Email</label>
                    <input type="email" class="form-control input-center" placeholder="Email" name="sp_email" id="sp_email" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_hst_number" class="sr-only">HST number</label>
                    <input type="text" class="form-control input-bottom" placeholder="HST number" name="sp_hst_number" id="sp_hst_number" pattern="[A-Za-z\d]*" maxlength="255">
                </div>
            </section>
            
            <section class="col-md-5" id='invoice_to'>
            
                <h3>To</h3>
                <p>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_name']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_title']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_phone']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_email']); ?>
                </p>
                
            </section>
            
            <div class="col-md-3 col-md-offset-1 text-right" id='invoice_for'>
                
                <h2>INVOICE</h2>
                
                <div class='form-group'>
                    <label for='invoice_id_for_sp' class='sr-only'>Invoice ID number</label>
                    <input type="text" id='invoice_id_for_sp' name='invoice_id_for_sp' class="form-control input-top" placeholder="Invoice ID number">
                </div>
                
                <div class='form-group'>
                    <label for='client_id' class='sr-only'>Client ID number</label>
                    <input type="text" id='client_id' name='client_id' class="form-control input-bottom" placeholder="Client ID number">
                </div>
            </div>
        </div>
        
        <div class="invoice-items-container row">
            
            <div class="col-md-12">
                <h3>Timesheet for adapted measures</h3>
            
                <div class="table-responsive">
                    <table class="table table-hover invoice-table">
                        
                        <thead>
                            <tr>
                                <th scope='col'></th>
                                <th scope='col'>Description</th>
                                <th scope='col'>Course code</th>
                                <th scope='col'>Activity</th>
                                <th scope='col' style='width: 10em;'>Date</th>
                                <th scope='col' style='min-width: 8em;'>Start time</th>
                                <th scope='col' style='min-width: 8em;'>End time</th>
                                <th scope='col' style='width: 10%;' data-popover="true" data-placement='top' data-content='= end time - start time'>Hour(s) <i class="fa fa-info-circle"></i></th>
                                <th scope='col'>Rate/hour ($)</th>
                                <th scope='col' style='width: 12%;' data-popover="true" data-placement='top' data-content='= rate * hours'>Amount ($) <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="invoice-item-row">
                                <td></td>
                                <td><input type="text" class="form-control invoice-item-input" name='description[]' placeholder="Description" required></td>
                                <td><input type="text" class="form-control invoice-item-input" name='course_code[]' placeholder="Course code" required></td>
                                <td>
                                    <select class='form-control' name='activity_id[]' required>
                                        <option value=''>Activity…</option>
                                        <?php
                                        foreach ($activities as $a) {
                                            echo "<option value='{$antiXSS->escape($a['activity_id'], $antiXSS::HTML_ATTR)}'>{$antiXSS->escape($a['activity_name_en'])}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control invoice-item-input invoice-item-date" placeholder="Date" name='service_date[]' required></td>
                                <td>
                                    <select class="form-control invoice-item-start-time" name='start_time[]'>
                                    <?php
                                        for ($hours = $settings['invoicing_earliest_possible_hour']; $hours <= $settings['invoicing_latest_possible_hour']; ++$hours) {
                                            for ($mins = 0; $mins < 60; $mins += 30) {
                                                echo '<option>' . str_pad($hours,2,'0',STR_PAD_LEFT) . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) . '</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control invoice-item-end-time" name='end_time[]'>
                                    <?php
                                        for ($hours = $settings['invoicing_earliest_possible_hour']; $hours <= $settings['invoicing_latest_possible_hour']; ++$hours) {
                                            for($mins = 0; $mins < 60; $mins += 30) {
                                                echo '<option>' . str_pad($hours,2,'0',STR_PAD_LEFT) . ':' . str_pad($mins,2,'0',STR_PAD_LEFT) . '</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td>
                                    <span class="invoice-item-hours">0</span> hours
                                    <span class="invoice-item-minutes">0</span> min
                                </td>
                                <td><input type="number" class="form-control invoice-item-input invoice-item-rate" name='rate[]' placeholder="Rate" min="0" step="0.01" required></td>
                                <td class="invoice-item-amounts">0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td colspan='9'><button type='button' class='btn btn-link add-invoice-item'><i class="fa fa-plus-square"></i> Add another item</button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2 col-md-offset-10 text-center invoice-total">
                <h3>Total <span id="invoice-total-dollar-amount">N/A</span></h3>
            </div>
        </div>
        
        <div class="invoice-files-container row">
            <div class="col-md-12">
                <h3><i class="fa fa-files-o"></i> Attachments</h3>
                
                <div class="table-responsive">
                    <table class="table table-hover invoice-files-table">
                        <tbody>
                            <tr class='invoice-file-row'>
                                <td></td>
                                <td>
                                    <input type="file" name="attachment[]">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>
                                    <button type='button' class='btn btn-link add-invoice-file'><i class='fa fa-plus-square'></i> Add another attachment</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row invoice-button-container">
            
            <div class="col-md-2 col-md-offset-6">
                <button id="invoice-btn-clear" type="button" class="btn btn-danger btn-block invoice-buttons"><i class="fa fa-repeat"></i> Clear form</button>
            </div>
            
            <div class="col-md-2">
                <button id="invoice-btn-draft" type="button" class="btn btn-warning btn-block invoice-buttons"><i class="fa fa-save"></i> Save draft</button>
            </div>
            
            <div class="col-md-2">
                <button id="invoice-btn-submit" type="submit" class="btn btn-success btn-block invoice-buttons"><i class="fa fa-check-square"></i> Submit invoice</button>
            </div>
        
        </div>
        
        <input type='hidden' name='mode' id='mode'>
    </form>

</div>
<script src="includes/js/invoice.js" charset="utf-8"></script>