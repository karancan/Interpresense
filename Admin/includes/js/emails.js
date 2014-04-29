/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-email-id="' + focus + '"]'), 15000);
        //@todo: add scroll
    }
});

/**
 *User wants to edit an email template
 */
$('[data-action="edit"]').click(function(){
    
    //Set form values
    $('#email_id').val($(this).closest('tr').data('email-id'));
    $('#email_subject').val($(this).closest('tr').data('email-subject'));
    $('#email_cc').val($(this).closest('tr').data('email-cc'));
    $('#email_bcc').val($(this).closest('tr').data('email-bcc'));
    $('#email_content').code($(this).closest('tr').data('email-content'));
    
    global.highlightRow($(this).closest('tr'));
    
});

/**
 *User has finished editing email template
 */
$('#admin-form-update-email').submit(function(e){
    $('#email_content').html($('#email_content').code());
});

/**
 *User wants to view an email template
 */
$('[data-action="view"]').click(function(){
    
    $('#email_content_view').code($(this).closest('tr').data('email-content'));
    global.highlightRow($(this).closest('tr'));
    
});

/**
 *The view email template dialog has been closed
 */
$('#admin-view-email-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-email-templates-table'));
});

/**
 *The edit email template dialog has been closed
 */
$('#admin-edit-email-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-email-templates-table'));
});