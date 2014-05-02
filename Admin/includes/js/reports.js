/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-focus="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-focus="' + focus + '"]').offset().top
        }, 1000);
    }
});

/**
 *User needs to be redirected to add a new template
 */
$('#redirect-add-template').click(function(){
    
    //Close the generate report modal and open the add a new template modal
    $('#admin-add-modal').modal('hide');
    $('[href="#admin-add-template-modal"]').trigger('click');
    
});

/**
 *User wants to add a template
 */
$('[data-action="add-template"]').click(function(){
    $('.group-add-template').show();
    $('#admin-add-template-modal .modal-title').text('Add a template');
    $('#template_name, #template_description').val('');
    $('#template_content').code('');
});

/**
 *User has selected a placeholder while adding a template
 */
$('#template_placeholders').change(function(){
    if($(this).val() !== ''){
        $('#template_content').code($('#template_content').code() + $(this).val());
        $('#template_placeholders').val(''); //Reset the select to go back to the first option
    }
});

/**
 *User wants to view a template
 */
$('#admin-report-templates [data-action="view"]').click(function(){
    $('.group-add-template').hide();
    $('#admin-add-template-modal .modal-title').text('View template');
    $('#template_content').code($(this).closest('tr').data('template-content'));
    
    global.highlightRow($(this).closest('tr'));
});

/**
 *User wants to delete a generated report
 */
$('#admin-reports-generated [data-action="delete"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm("Are you sure you want to delete this report?  This action is not reversible.")){
        $.ajax({
            type: 'post',
            url: 'reports.php?page=mark-report-as-deleted',
            data: {
                report_id: $(this).closest('tr').data('report-id')
            }
        }).done(function() {
            window.location.href = 'reports.php';
        });
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
});

/**
 *User wants to delete a report template
 */
$('#admin-report-templates [data-action="delete"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm("Are you sure you want to delete this template? This action is not reversible and will not delete the reports generated using this template.")){
        $.ajax({
            type: 'post',
            url: 'reports.php?page=mark-template-as-deleted',
            data: {
                template_id: $(this).closest('tr').data('template-id')
            }
        }).done(function() {
            window.location.href = 'reports.php';
        });
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
});

/**
 *The add/edit user dialog has been closed
 */
$('#admin-add-template-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-report-templates'));
});