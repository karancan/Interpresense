<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-users"></i> Administrative users</h3>
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a user</a>        
        </div>
        <div class="col-md-2">
            <a href="users.php?page=export-users" class="btn btn-info btn-block admin-add-button"><i class="fa fa-table"></i> Export (CSV format)</a>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>All administrative user accounts</h4>
            
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
                        <?php
                        if (empty($users)){
                            echo "<tr><td colspan='7' class='empty-table-placeholder'>No administrative users to be shown at this point…</td></tr>";
                        } else {
                            foreach($users as $u) {
                                echo "<tr data-user-id='{$antiXSS->escape($u['user_id'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     "<td>Coming soon</td>" .
                                     '<td class="table-option-cell">
                                      </td>' .
                                     '</tr>';
                            }
                        }
                        ?>
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
                <h4 class="modal-title">Add a user</h4>
            </div>
            
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="control-label">Instructions</label>
                    <p>The user will receive an email to confirm their account and set up their password after the account has been added.</p>
                </div>
                
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
                    <input type="text" class="form-control datepicker" id="expires_on">
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </div>
    </div>
</div>
<script>
    
    //Init datepickers
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    
</script>