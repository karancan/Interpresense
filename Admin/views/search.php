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
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
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
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
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
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
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
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Column</th>
                            <th scope='col'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
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