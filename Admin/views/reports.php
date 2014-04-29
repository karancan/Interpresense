<style>
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-bar-chart-o"></i> Reports</h3>
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-bar-chart-o"></i> Generate report</a>        
        </div>
        <div class="col-md-2">
            <a data-toggle="modal" href="#admin-add-template-modal" class="btn btn-info btn-block admin-add-button"><i class="fa fa-plus"></i> Add a template</a>        
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
                        <?php
                        if (empty($reportsGenerated)){
                            echo "<tr><td colspan='3' class='empty-table-placeholder'>No reports have been generated at this point…</td></tr>";
                        } else {
                            foreach($reportsGenerated as $r) {
                                echo "<tr data-report-id='{$antiXSS->escape($r['report_id'], $antiXSS::HTML_ATTR)}'>" .
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
                        <?php
                        if (empty($reportsTemplates)){
                            echo "<tr><td colspan='3' class='empty-table-placeholder'>No report templates to be shown at this point…</td></tr>";
                        } else {
                            foreach($reportsTemplates as $r) {
                                echo "<tr data-template-id='{$antiXSS->escape($r['template_id'], $antiXSS::HTML_ATTR)}'>" .
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
                <h4 class="modal-title">Generate a new report</h4>
            </div>
            
            <div class="modal-body">
            
                <?php
                if (empty($reportsTemplates)){
                ?>
                
                <p>A report cannot be generated at this time because there are no templates…</p>
                
                <?php
                } else {
                ?>
                
                <div class="form-group">
                    <label class="control-label" for="report_type">Select the template you'd like to use</label>
                    <select class="form-control" id="report_type">
                        <option value="">Pick a template…</option>
                        <?php
                        foreach($reportsTemplates as $r) {
                            echo '<option value="' . $antiXSS->escape($r['template_id'], $antiXSS::HTML_ATTR) . '">' . $antiXSS->escape($r['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <?php } ?>

            </div>
                
            <div class="modal-footer">
                <?php
                if (!empty($reportsTemplates)){
                    echo '<button type="button" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>';
                }
                else{
                    echo '<button type="button" class="btn btn-info pull-left" id="redirect-add-template"><i class="fa fa-plus"></i> Add a template</button>';
                }
                ?>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="admin-add-template-modal" tabindex="-1" role="dialog" aria-labelledby="admin-add-template-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center modal-wide">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add a template</h4>
            </div>
            
            <div class="modal-body">
                <!-- @todo: add rick text editor -->
            </div>
                
            <div class="modal-footer">
                
            </div>
            
        </div>
    </div>
</div>
<script charset='utf-8' src='includes/js/reports.js'></script>