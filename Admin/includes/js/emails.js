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
    $('#email_cc').val($(this).closest('tr').data('email-cc'));
    $('#email_bcc').val($(this).closest('tr').data('email-bcc'));
    $('#email_content').val($(this).closest('tr').data('email-content'));
    
    global.highlightRow($(this).closest('tr'));
    
});

/**
 *The add/edit settings dialog has been closed
 */
$('#admin-edit-email-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-email-templates-table'));
});