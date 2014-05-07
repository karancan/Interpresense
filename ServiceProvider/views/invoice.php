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
    
    <form method="post" action="#">
        
        <div class="row">
            <div class="col-md-3">
                
                <h3>From</h3>
                <input type="text" class="form-control input-top" placeholder="Your name">
                <input type="text" class="form-control input-center" placeholder="Your phone number">
                <input type="text" class="form-control input-center" placeholder="Your email">
                <input type="text" class="form-control input-bottom" placeholder="Your address">
            </div>
            
            <div class="col-md-5">
            
                <h3>To</h3>
                <p>
                    <?php echo $settings['institution_dept_recipient_name']; ?><br>
                    <?php echo $settings['institution_dept_recipient_title']; ?><br>
                    <?php echo $settings['institution_dept_recipient_phone']; ?><br>
                    <?php echo $settings['institution_dept_recipient_email']; ?>
                </p>
                
            </div>
            
            <div class="col-md-3 col-md-offset-1 invoice-for">
                
                <h2>INVOICE</h2>
                
                <input type="text" class="form-control input-top" placeholder="Client ID number">
                <input type="text" class="form-control input-bottom" placeholder="Client name" readonly title="Enter a client ID to see a name appear here...">
                
            </div>
        </div>
        
        <div class="invoice-items-container row">
            
            <div class="col-md-12">
                <h3>Timesheet for adapted measures</h3>
            
                <div class="table-responsive">
                    <table class="table table-hover invoice-table">
                        
                        <thead>
                            <tr>
                                <th scope='col'>Description</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Start time</th>
                                <th scope='col'>End time</th>
                                <!-- TODO: don't know how to get tooltips working -->
                                <th scope='col' style='width: 10%;' data-toggle='tooltip' data-placement='top' title='= end time - start time'>Hour(s) <i class="fa fa-info-circle"></i></th>
                                <th scope='col'>Rate/hour ($)</th>
                                <!-- TODO: don't know how to get tooltips working -->
                                <th scope='col' style='width: 12%;' data-toggle='tooltip' data-placement='top' title='= rate * hours'>Amount ($) <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="invoice-item-row">
                                <td><input type="text" class="form-control invoice-item-input" placeholder="Description" required></td>
                                <td><input type="text" class="form-control invoice-item-input invoice-item-date" placeholder="Date" required></td>
                                <td>
                                    <select class="form-control invoice-item-start-time">
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
                                    <select class="form-control invoice-item-end-time">
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
                                <td><input type="number" class="form-control invoice-item-input invoice-item-rate" placeholder="Rate" min="0" step="0.01" required></td>
                                <td class="invoice-item-amounts">20.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2 col-md-offset-10 invoice-total">
                <h3>Total <span id="invoice-total-dollar-amount">N/A</span></h3>
            </div>
        <div>
        
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-files-o"></i> Attachments</h3>
            </div>
        </div>
        
        <!-- @todo: add table for potential attachments -->
        
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

    </form>

</div>
<script src="includes/js/invoice.js" charset="utf-8"></script>