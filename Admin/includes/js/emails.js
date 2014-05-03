/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-email-id="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-email-id="' + focus + '"]').offset().top
        }, 1000);
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
 *User has selected a placeholder while adding a template
 */
$('#email_placeholders').change(function(){
    if($(this).val() !== ''){
        $('#email_content').code($('#email_content').code() + $(this).val());
        $('#email_placeholders').val(''); //Reset the select to go back to the first option
    }
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