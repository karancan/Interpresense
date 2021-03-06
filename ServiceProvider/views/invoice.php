<style>
    @import url('includes/css/serviceProvider.css');
</style>
<div class="container">
    
    <div class="row">
        
        <div class="col-md-12">
            <div class="well invoice-instructions">
                <h3 class="page-title"><i class="fa fa-info-circle"></i> <?php $translate->_e('instructionsHeader'); ?></h3>
                <ul>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                    <li>Lorem ipsum wipsum dimsum wipsum dimsum wipsum dimsumwipsum dimsum wipsum dimsum wipsum dimsum wipsum dimsum</li>
                </ul>
            </div>
        </div>
        
    </div>
    
    <form method="post" action="index.php?page=invoice-submission" id='invoice_form' enctype='multipart/form-data'>
        
        <div class="row">
            <section class="col-md-3" id='invoice_from'>
                
                <h3><?php $translate->_e('invoiceFrom'); ?></h3>
                
                <div class='form-group'>
                    <label for="sp_name" class="sr-only"><?php $translate->_e('namePlaceholder'); ?></label>
                    <input type="text" class="form-control input-top" placeholder="<?php echo $antiXSS->escape($translate->_e('namePlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_name" id="sp_name" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_address" class="sr-only"><?php $translate->_e('addressPlaceholder'); ?></label>
                    <input type="text" class="form-control input-center" placeholder="<?php echo $antiXSS->escape($translate->_e('addressPlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_address" id="sp_address" maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_city" class="sr-only"><?php $translate->_e('cityPlaceholder'); ?></label>
                    <input type="text" class="form-control input-center" placeholder="<?php echo $antiXSS->escape($translate->_e('cityPlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_city" id="sp_city" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_province" class="sr-only"><?php $translate->_e('provincePlaceholder'); ?></label>
                    <select class="form-control input-center" name="sp_province" id="sp_province" required>
                        <option value=""><?php $translate->_e('provincePlaceholder'); ?></option>
                        <option value="AB"><?php $translate->_e('prov_AB'); ?></option>
                        <option value="BC"><?php $translate->_e('prov_BC'); ?></option>
                        <option value="MB"><?php $translate->_e('prov_MB'); ?></option>
                        <option value="NB"><?php $translate->_e('prov_NB'); ?></option>
                        <option value="NL"><?php $translate->_e('prov_NL'); ?></option>
                        <option value="NT"><?php $translate->_e('prov_NT'); ?></option>
                        <option value="NS"><?php $translate->_e('prov_NS'); ?></option>
                        <option value="NU"><?php $translate->_e('prov_NU'); ?></option>
                        <option value="ON"><?php $translate->_e('prov_ON'); ?></option>
                        <option value="PQ"><?php $translate->_e('prov_PQ'); ?></option>
                        <option value="SK"><?php $translate->_e('prov_SK'); ?></option>
                        <option value="YT"><?php $translate->_e('prov_YT'); ?></option>
                    </select>
                </div>
                
                <div class='form-group'>
                    <label for="sp_postal_code" class="sr-only"><?php $translate->_e('postalCodePlaceholder'); ?></label>
                    <input type="text" class="form-control input-center" placeholder="<?php echo $antiXSS->escape($translate->_e('postalCodePlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_postal_code" id="sp_postal_code" required pattern="^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]\d[ABCEGHJKLMNPRSTVWXYZ]\d$" maxlength="6">
                </div>
                
                <div class='form-group'>
                    <label for="sp_phone" class="sr-only"><?php $translate->_e('phoneNumberPlaceholder'); ?></label>
                    <input type="tel" class="form-control input-center" placeholder="<?php echo $antiXSS->escape($translate->_e('phoneNumberPlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_phone" id="sp_phone" required pattern='\d+' maxlength="10">
                </div>
                
                <div class='form-group'>
                    <label for="sp_email" class="sr-only"><?php $translate->_e('emailPlaceholder'); ?></label>
                    <input type="email" class="form-control input-center" placeholder="<?php echo $antiXSS->escape($translate->_e('emailPlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_email" id="sp_email" required maxlength="255">
                </div>
                
                <div class='form-group'>
                    <label for="sp_hst_number" class="sr-only"><?php $translate->_e('hstNumberPlaceholder'); ?></label>
                    <input type="text" class="form-control input-bottom" placeholder="<?php echo $antiXSS->escape($translate->_e('hstNumberPlaceholder'), $antiXSS::HTML_ATTR); ?>" name="sp_hst_number" id="sp_hst_number" pattern="[A-Za-z\d]*" maxlength="255">
                </div>
            </section>
            
            <section class="col-md-5" id='invoice_to'>
            
                <h3><?php $translate->_e('invoiceTo'); ?></h3>
                <p>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_name']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_title']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_phone']); ?><br>
                    <?php echo $antiXSS->escape($settings['institution_dept_recipient_email']); ?>
                </p>
                
            </section>
            
            <div class="col-md-3 col-md-offset-1 text-right" id='invoice_for'>
                
                <h2><?php echo mb_strtoupper($translate->__('invoice')); ?></h2>
                
                <div class='form-group'>
                    <label for='invoice_id_for_sp' class='sr-only'><?php $translate->_e('invoiceID'); ?></label>
                    <input type="text" id='invoice_id_for_sp' name='invoice_id_for_sp' class="form-control input-top" placeholder="<?php echo $antiXSS->escape($translate->__('invoiceID'), $antiXSS::HTML_ATTR); ?>">
                </div>
                
                <div class='form-group'>
                    <label for='client_id' class='sr-only'><?php $translate->_e('clientID'); ?></label>
                    <input type="text" id='client_id' name='client_id' class="form-control input-bottom" placeholder="<?php echo $antiXSS->escape($translate->__('clientID'), $antiXSS::HTML_ATTR); ?>">
                </div>
            </div>
        </div>
        
        <div class="invoice-items-container row">
            
            <div class="col-md-12">
                <h3><?php $translate->_e('timesheetHeader'); ?></h3>
            
                <div class="table-responsive">
                    <table class="table table-hover invoice-table">
                        
                        <thead>
                            <tr>
                                <th scope='col'></th>
                                <th scope='col'><?php $translate->_e('description'); ?></th>
                                <th scope='col'><?php $translate->_e('courseCode'); ?></th>
                                <th scope='col'><?php $translate->_e('activity'); ?></th>
                                <th scope='col' style='width: 10em;'><?php $translate->_e('date'); ?></th>
                                <th scope='col' style='min-width: 8em;'><?php $translate->_e('startTime'); ?></th>
                                <th scope='col' style='min-width: 8em;'><?php $translate->_e('endTime'); ?></th>
                                <th scope='col' style='width: 10%;' data-popover="true" data-placement='top' data-content='<?php echo $antiXSS->escape($translate->__('hoursTooltip'), $antiXSS::HTML_ATTR); ?>'><?php $translate->_e('hours'); ?> <i class="fa fa-info-circle"></i></th>
                                <th scope='col'><?php $translate->_e('ratePerHour'); ?></th>
                                <th scope='col' style='width: 12%;' data-popover="true" data-placement='top' data-content='<?php echo $antiXSS->escape($translate->__('amountTooltip'), $antiXSS::HTML_ATTR); ?>'><?php $translate->_e('amount'); ?> <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="invoice-item-row">
                                <td></td>
                                <td><input type="text" class="form-control invoice-item-input" name='description[]' placeholder="<?php echo $antiXSS->escape($translate->__('descriptionPlaceholder'), $antiXSS::HTML_ATTR); ?>" required></td>
                                <td><input type="text" class="form-control invoice-item-input" name='course_code[]' placeholder="<?php echo $antiXSS->escape($translate->__('courseCodePlaceholder'), $antiXSS::HTML_ATTR); ?>" required></td>
                                <td>
                                    <select class='form-control' name='activity_id[]' required>
                                        <option value=''><?php $translate->_e('activityPlaceholder'); ?></option>
                                        <?php
                                        foreach ($activities as $a) {
                                            echo "<option value='{$antiXSS->escape($a['activity_id'], $antiXSS::HTML_ATTR)}'>{$antiXSS->escape($a['activity_name_en'])}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control invoice-item-input invoice-item-date" placeholder="<?php echo $antiXSS->escape($translate->__('datePlaceholder'), $antiXSS::HTML_ATTR); ?>" name='service_date[]' required></td>
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
                                    <span class="invoice-item-hours">0</span> <?php $translate->_e('hoursUnit'); ?>
                                    <span class="invoice-item-minutes">0</span> <?php $translate->_e('minutesUnit'); ?>
                                </td>
                                <td><input type="number" class="form-control invoice-item-input invoice-item-rate" name='rate[]' placeholder="<?php echo $antiXSS->escape($translate->__('ratePlaceholder'), $antiXSS::HTML_ATTR); ?>" min="0" step="0.01" required></td>
                                <td class="invoice-item-amounts">0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td colspan='9'><button type='button' class='btn btn-link add-invoice-item'><i class="fa fa-plus-square"></i> <?php $translate->_e('addItem'); ?></button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2 col-md-offset-10 text-center invoice-total">
                <h3><?php $translate->_e('total'); ?> <span id="invoice-total-dollar-amount">N/A</span></h3>
            </div>
        </div>
        
        <div class="invoice-files-container row">
            <div class="col-md-12">
                <h3><i class="fa fa-files-o"></i> <?php $translate->_e('attachmentsHeader'); ?></h3>
                
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
                                    <button type='button' class='btn btn-link add-invoice-file'><i class='fa fa-plus-square'></i> <?php $translate->_e('addAttachment'); ?></button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row invoice-button-container">
            
            <div class="col-md-2 col-md-offset-6">
                <button id="invoice-btn-clear" type="button" class="btn btn-danger btn-block invoice-buttons"><i class="fa fa-repeat"></i> <?php $translate->_e('clearBtn'); ?></button>
            </div>
            
            <div class="col-md-2">
                <button id="invoice-btn-draft" type="button" class="btn btn-warning btn-block invoice-buttons"><i class="fa fa-save"></i> <?php $translate->_e('saveDraftBtn'); ?></button>
            </div>
            
            <div class="col-md-2">
                <button id="invoice-btn-submit" type="submit" class="btn btn-success btn-block invoice-buttons"><i class="fa fa-check-square"></i> <?php $translate->_e('submitBtn'); ?></button>
            </div>
        
        </div>
        
        <input type='hidden' name='mode' id='mode'>
    </form>

</div>
<script src="includes/js/invoice.js" charset="utf-8"></script>