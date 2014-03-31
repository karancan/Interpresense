<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h3 class="admin-page-title"><i class="fa fa-folder-open"></i> Invoices Expected</h3>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <a data-toggle="modal" href="#admin-add-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add expected invoice</a>        
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Existing expected invoices</h4>
            
            <table class="table table-hover invoice-table">           
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
        
        </div>
        
    </div>
    
</div>

<div class="modal fade" id="admin-add-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add an expected invoice</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="form-group">
                    <label class="control-label" for="student_name">Student name</label>
                    <input type="text" class="form-control" id="student_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="student_num">Student number</label>
                    <input type="text" class="form-control" id="student_num">
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </div>
    </div>
</div>