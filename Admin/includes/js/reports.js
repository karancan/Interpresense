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