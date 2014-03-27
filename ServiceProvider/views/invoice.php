<style>
    @import url('includes/css/invoice.css');
</style>
<div class="container">

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
                <h5>Fetch from DB</h5>
                <h5>Fetch from DB</h5>
                <h5>Fetch from DB</h5>
                
            </div>
            
            <div class="col-md-3 col-md-offset-1 invoice-for">
                
                <h2>INVOICE</h2>
                
                <input type="text" class="form-control input-top" placeholder="Client name">
                <input type="text" class="form-control input-bottom" placeholder="Client ID number">
                
            </div>
        </div>
        
        <div class="invoice-items-container">
            
            <h3>Invoice items</h3>
        
        </div>

        <div class="row">
            <div class="col-md-12">
                
                <div class="table-responsive">
                    <table class="table table-hover invoice-table">
                        
                        <thead>
                            <tr>
                                <th scope='col'>Description</th>
                                <th scope='col' style='width: 5%;'>Date</th>
                                <th scope='col' style='width: 2%;'>Start</th>
                                <th scope='col' style='width: 2%;'>End</th>
                                <th scope='col'>Hours <i class="fa fa-info-circle"></i></th>
                                <th scope='col' style='width: 10%;'>Rate</th>
                                <th scope='col'>Amount <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //Just here for illustration purposes...
                                for ($i=0; $i<4; $i++){
                                    echo '<tr>';
                                    echo '<td><input type="text" class="form-control" placeholder="Add description here"></td>';
                                    echo '<td><input type="date" class="form-control"></td>';
                                    echo '<td><input type="time" step="1" class="form-control"></td>';
                                    echo '<td><input type="time" step="1" class="form-control"/></td>';
                                    echo '<td>Something</td>';
                                    echo '<td><input type="number" class="form-control" placeholder="Add rate here"></td>';
                                    echo '<td>Something</td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-2 col-md-offset-10 invoice-total">
                <h3>Total <span id="invoice-total-dollar-amount">$200.20</span></h3>
            </div>
        <div>
        
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
<?die()?>