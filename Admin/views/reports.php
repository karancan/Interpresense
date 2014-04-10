<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h3 class="admin-page-title"><i class="fa fa-bar-chart-o"></i> Reports</h3>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <a data-toggle="modal" href="#admin-add-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Generate report</a>        
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Reports generated</h4>
            
            <table class="table table-hover">           
                <thead>
                    <tr>
                        <th scope='col'>Report</th>
                        <th scope='col'>Generated on</th>
                        <th scope='col'>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Report templates</h4>
            
            <table class="table table-hover">           
                <thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Created on</th>
                        <th scope='col'>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
</div>

<div class="modal fade" id="admin-add-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Generate a report</h4>
            </div>
            
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="control-label" for="report_type">Template</label>
                    <select class="form-control" id="report_type">
                        <option>Something</option>
                        <option>Something else</option>
                    </select>
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </div>
    </div>
</div>