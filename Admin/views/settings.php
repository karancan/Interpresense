<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-gears"></i> Settings</h3>
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-setting-modal" data-action="add-setting" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a setting</a>        
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-activity-modal" data-action="add-activity" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add an activity</a>        
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <h4>Activity types</h4>
                    
            <table id="admin-activities-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Added on</th>
                        <th scope='col' style='width: 17%;'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($activities)){
                        echo "<tr><td colspan='4' class='empty-table-placeholder'>No service provider activities to be shown at this point…</td></tr>";
                    } else {
                        foreach($activities as $s) {
                            echo "<tr data-focus='{$antiXSS->escape($s['activity_id'], $antiXSS::HTML_ATTR)}'
                                      data-activity-name-en='{$antiXSS->escape($s['activity_name_en'], $antiXSS::HTML_ATTR)}'
                                      data-activity-name-fr='{$antiXSS->escape($s['activity_name_fr'], $antiXSS::HTML_ATTR)}'>" .
                                 "<td>{$s['activity_name_en']}</td>" .
                                 "<td>{$s['activity_name_fr']}</td>" .
                                 "<td>" . $dateFmt->format($s['inserted_on'], 'date_time') . "</td>" .
                                 '<td class="table-option-cell">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-add-activity-modal" data-action="edit"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger" data-action="delete"><i class="fa fa-minus"></i> Delete</button>
                                  </td>' .
                                 '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
            
            <h4>Application settings</h4>
            
            <table id="admin-settings-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Value</th>
                        <th scope='col' style='width: 17%;'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($appSettings)){
                        echo "<tr><td colspan='3' class='empty-table-placeholder'>No settings to be shown at this point…</td></tr>";
                    } else {
                        foreach($appSettings as $s) {
                            echo "<tr data-focus='{$antiXSS->escape($s['setting_key'], $antiXSS::HTML_ATTR)}'
                                      data-setting-key='{$antiXSS->escape($s['setting_key'], $antiXSS::HTML_ATTR)}'
                                      data-setting-value='{$antiXSS->escape($s['setting_value'], $antiXSS::HTML_ATTR)}'
                                      data-setting-description='" . (empty($s['description_en']) ? 'N/A' : $antiXSS->escape($s['description_en'], $antiXSS::HTML_ATTR)). "'>" .
                                 "<td>{$s['setting_key']}</td>" .
                                 "<td>{$s['setting_value']}</td>" .
                                 '<td class="table-option-cell">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-add-setting-modal" data-action="edit"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger" data-action="delete"><i class="fa fa-minus"></i> Delete</button>
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

<div class="modal" id="admin-add-setting-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-setting-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form action='settings.php?page=change-setting' method='POST' class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            
            <div class="modal-body">
                
                <div id="setting_description_container" class="form-group">
                    <label class="control-label">Description</label>
                    <p id="setting_description"></p>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="setting_name">Setting name</label>
                    <input type="text" class="form-control" id="setting_name" name='key' required>
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

<div class="modal" id="admin-add-activity-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-setting-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center">
        <form action='settings.php?page=change-activity' method='POST' class="modal-content">
            
            <input type="hidden" name="activity_id" value="">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="control-label" for="setting_name">Name (English)</label>
                    <input type="text" class="form-control" id="name_en" name='activity_name_en' required>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="setting_value">Name (Français)</label>
                    <input type="text" class="form-control" id="name_fr" name='activity_name_fr' required>
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>
<script charset='utf-8' src='includes/js/settings.js'></script>
<script>
    'use strict';
    var focus = '<?= $antiXSS->escape($_GET['focus'], $antiXSS::JS) ?>';
</script>