<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h3 class="admin-page-title"><i class="fa fa-gears"></i> Settings</h3>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <a data-toggle="modal" href="#admin-add-setting-modal" data-action="add" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a setting</a>        
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Application settings</h4>
            
            <table id="admin-settings-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>Setting name</th>
                        <th scope='col'>Setting value</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($appSettings as $s) {
                        echo "<tr data-setting-id='{$s['setting_key']}' data-setting-key='{$s['setting_key']}' data-setting-value='{$s['setting_value']}'>" .
                             "<td>{$s['setting_key']}</td>" .
                             "<td>{$s['setting_value']}</td>" .
                             '<td class="table-option-cell">
                                <button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-add-setting-modal" data-action="edit"><i class="fa fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-danger" data-action="delete"><i class="fa fa-minus"></i> Delete</button>
                              </td>' .
                             '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-users"></i> Users</h3>
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a user</a>        
        </div>
        <div class="col-md-2">
            <a href="settings.php?page=export-users" class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export</a>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>Existing user accounts</h4>
            
            <table id="admin-users-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>User ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Created on</th>
                        <th scope='col'>Expires on</th>
                        <th scope='col'>Account confirmed</th>
                        <th scope='col'>Last log in</th>
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

<div class="modal fade" id="admin-add-setting-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-setting-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form action='settings.php?page=change-setting' method='POST' class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add setting</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="form-group">
                    <label class="control-label" for="setting_name">Setting name</label>
                    <input type="text" class="form-control" id="setting_name" name='key'>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="setting_value">Setting value</label>
                    <input type="text" class="form-control" id="setting_value" name='value'>
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>

<div class="modal fade" id="admin-add-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add a user</h4>
            </div>
            
            <div class="modal-body">
            
                <div class="form-group">
                    <label class="control-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="first_name">First name</label>
                    <input type="text" class="form-control" id="first_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="expires_on">Expires on</label>
                    <input type="text" class="form-control" id="expires_on">
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </div>
    </div>
</div>
<script charset='utf-8' src='includes/js/settings.js'></script>