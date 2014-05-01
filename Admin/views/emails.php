<style>
    @import url('//<?= URL_VENDOR_FRONTEND ?>/summernote/summernote-dist/summernote.css');
    @import url('includes/css/admin.css');
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h3 class="admin-page-title"><i class="fa fa-envelope"></i> Email templates</h3>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
        
            <h4>All email templates</h4>
            
            <table id="admin-email-templates-table" class="table table-hover invoice-table">           
                <thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Subject</td>
                        <th scope='col'>CC</th>
                        <th scope='col'>BCC</th>
                        <th scope='col' style='width: 25%;'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if (empty($emailTemplates)){
                            echo "<tr><td colspan='6' class='empty-table-placeholder'>No email templates at this time…</td></tr>";
                        } else {
                            foreach($emailTemplates as $e) {
                                echo "<tr data-email-id='{$antiXSS->escape($e['email_id'], $antiXSS::HTML_ATTR)}'
                                          data-email-subject='{$antiXSS->escape($e['subject'], $antiXSS::HTML_ATTR)}'
                                          data-email-cc='{$antiXSS->escape($e['cc'], $antiXSS::HTML_ATTR)}'
                                          data-email-bcc='{$antiXSS->escape($e['bcc'], $antiXSS::HTML_ATTR)}'
                                          data-email-content='{$antiXSS->escape($e['content'], $antiXSS::HTML_ATTR)}'>" .
                                     "<td>{$e['name']}</td>" .
                                     "<td>{$e['description']}</td>" .
                                     "<td>{$antiXSS->escape($e['subject'])}</td>" .
                                     "<td>{$antiXSS->escape($e['cc'])}</td>" .
                                     "<td>{$antiXSS->escape($e['bcc'])}</td>" .
                                     '<td class="table-option-cell">
                                          <button type="button" class="btn btn-info" data-toggle="modal" href="#admin-view-email-modal" data-action="view"><i class="fa fa-eye"></i> View content</button>
                                          <button type="button" class="btn btn-warning" data-toggle="modal" href="#admin-edit-email-modal" data-action="edit"><i class="fa fa-edit"></i> Edit template</button>
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

<div class="modal fade" id="admin-edit-email-modal" tabindex="-1" role="dialog" aria-labelledby="admin-edit-email-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center modal-wide">
        <form id="admin-form-update-email" action='emails.php?page=update-email' method='POST' class="modal-content">
            
            <input type="hidden" id="email_id" name="email_id" value="">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit email template</h4>
            </div>
            
            <div class="modal-body">
                
               <div class="form-group">
                    <label class="control-label" for="email_subject">Subject</label>
                    <input type="text" class="form-control" id="email_subject" name='subject'>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="email_cc">Who gets CC'd</label>
                    <input type="text" class="form-control" id="email_cc" name='cc'>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="email_bcc">Who gets BCC'd</label>
                    <input type="text" class="form-control" id="email_bcc" name='bcc'>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="email_content">Email content</label>
                    <textarea class="form-control summernote" id="email_content" name='content'></textarea>
                </div>
            
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
            </div>
            
        </form>
    </div>
</div>

<div class="modal fade" id="admin-view-email-modal" tabindex="-1" role="dialog" aria-labelledby="admin-view-email-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vertical-center modal-wide">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">View email content</h4>
            </div>
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label" for="email_content_view">Email content</label>
                    <textarea class="form-control summernote-readonly" id="email_content_view"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>

<script src='//<?= URL_VENDOR_FRONTEND ?>/summernote/summernote-dist/summernote.min.js'></script>
<script charset='utf-8' src='includes/js/emails.js'></script>
<script>
    'use strict';
    var focus = '<?= $antiXSS->escape($_GET['focus'], $antiXSS::JS) ?>';
    
    //Init rich text editor
    $('.summernote').summernote({
        height: '300',
        tabsize: 3
    });
    
    $('.summernote-readonly').summernote({
        height: '300',
        tabsize: 3,
        toolbar: []
    });
</script>