<style>
    @import url('//<?= URL_VENDOR_FRONTEND ?>/datatables-bootstrap3/BS3/assets/css/datatables.css');
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-users"></i> Administrative users</h3>
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-modal" data-action="add-user" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a user</a>        
        </div>
        <div class="col-md-2">
            <a href="users.php?page=export-users" download target="_blank" class="btn btn-info btn-block admin-add-button"><i class="fa fa-file-excel-o"></i> Export (CSV format)</a>
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
                        <th scope='col'>Created</th>
                        <th scope='col'>Expires</th>
                        <th scope='col'>Acc. confirmed</th>
                        <th scope='col'>Last log in</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($users)){
                        foreach($users as $u) {
                            echo "<tr data-user-id='{$antiXSS->escape($u['user_id'], $antiXSS::HTML_ATTR)}'
                                      data-user-username='{$antiXSS->escape($u['user_name'], $antiXSS::HTML_ATTR)}'
                                      data-user-first-name='{$antiXSS->escape($u['first_name'], $antiXSS::HTML_ATTR)}'
                                      data-user-last-name='{$antiXSS->escape($u['last_name'], $antiXSS::HTML_ATTR)}'
                                      data-user-expires-on='{$antiXSS->escape($u['expires_on'], $antiXSS::HTML_ATTR)}'>" .
                                 "<td>" . $u['user_name'] . "</td>" .
                                 "<td>" . $u['first_name'] . " " . $u['last_name'] . "</td>" .
                                 "<td>" . $dateFmt->format($u['created_on'], 'date_time') . "</td>" .
                                 "<td>" . $dateFmt->format($u['expires_on'], 'date_time') . "</td>" .
                                 "<td>" . (empty($u['is_confirmed']) ? 'No' : 'Yes') . "</td>" .
                                 "<td>" . $dateFmt->format($u['last_log_in'], 'date_time') . "</td>" .
                                 '<td class="table-option-cell">
                                     <button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-add-modal" data-action="edit"><i class="fa fa-edit"></i> Edit</button>
                                  </td>' .
                                 '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        
        </div>
        
    </div>
    
</div>

<div class="modal" id="admin-add-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form action='users.php?page=change-user' method='POST' class="modal-content">
            
            <input type="hidden" name="user_id" value="">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add a user</h4>
            </div>
            
            <div class="modal-body">
                
                <div class="form-group" id="user-instructions-container">
                    <label class="control-label">Instructions</label>
                    <p>The user will receive an email to confirm their account and set up their password after the account has been added.</p>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="user_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="first_name">First name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="last_name">Last name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="expires_on">Expires on</label>
                    <input type="text" class="form-control datepicker" id="expires_on" name="expires_on">
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>
<script charset='utf-8' src='//<?= URL_VENDOR_FRONTEND ?>/datatables-bootstrap3/BS3/assets/js/datatables.js'></script>
<script charset='utf-8' src='includes/js/users.js'></script>
<script>
    'use strict';
    var focus = '<?= $antiXSS->escape($_GET['focus'], $antiXSS::JS) ?>';
</script>