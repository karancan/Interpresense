<style>
    @import url('includes/css/serviceProvider.css');
</style>
<div class="container">

    <form>
        
        <div class="row">
            <div class="col-md-3">
                
                <h3>From</h3>
                <input type="text" placeholder="Your name"><br>
                <input type="text" placeholder="Your phone number"><br>
                <input type="text" placeholder="Your email"><br>
                <input type="text" placeholder="Your address">
            </div>
            
            <div class="col-md-6">
            
                <h3>To</h3>
                <h5>Fetch from DB</h5>
                <h5>Fetch from DB</h5>
                <h5>Fetch from DB</h5>
                
            </div>
            
            <div class="col-md-3 invoice-for">
                
                <h2>INVOICE</h2>
                
                <input type="text" placeholder="Client name">
                <input type="text" placeholder="Client ID number">
                
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
                                <th>Description</th>
                                <th>Date</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Hours <i class="fa fa-info-circle fa-2x"></i></th>
                                <th>Rate</th>
                                <th>Amount <i class="fa fa-info-circle fa-2x"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //Just here for illustration purposes...
                                for ($i=0; $i<4; $i++){
                                    echo '<tr>';
                                    echo '<td><input type="text"></td>';
                                    echo '<td><input type="date"></td>';
                                    echo '<td><input type="time" step="1"></td>';
                                    echo '<td><input type="time" step="1" /></td>';
                                    echo '<td>Something</td>';
                                    echo '<td><input type="number"></td>';
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
            <div class="col-md-3 col-md-offset-9 invoice-total">
                <h3>Total: $200.20</h3>
            </div>
        <div>
        
        <div class="row invoice-button-container">
            
            <div class="col-md-2 col-md-offset-6">
                <button type="button" class="btn btn-danger btn-block invoice-buttons"><i class="fa fa-repeat"></i> Clear form</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-block invoice-buttons"><i class="fa fa-save"></i> Save draft</button>
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-block invoice-buttons"><i class="fa fa-check-square"></i> Submit invoice</button>
            </div>
        
        </div>

    </form>

</div>