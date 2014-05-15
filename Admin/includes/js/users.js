/**
 *Actions to be run when page is done loading
 */
$(document).ready(function(){
    
    //Focus on a specific row (if applicable)
    if (focus !== ''){
        global.highlightRow($('[data-user-id="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-user-id="' + focus + '"]').offset().top
        }, 1000);
    }
    
    //Init datatable
    $('#admin-users-table').dataTable({
        "aLengthMenu": [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, 'All']
        ],
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [-1]
        }],
        "iDisplayLength": -1
    });
    
    //Init datepickers
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+1d'
    });
    
});

/**
 *User wants to add a user
 */
$('[data-action="add-user"]').click(function(){
    $('#user-instructions-container').show();
    $('#admin-add-modal .modal-title').text('Add a user');
    $('#username, #first_name, #last_name, #expires_on, input[name="user_id"]').val('');
});

/**
 *User wants to edit a user
 */
$('[data-action="edit"]').click(function(){
    
    $('#user-instructions-container').hide();
    $('#admin-add-modal .modal-title').text('Edit user');
    
    $('input[name="user_id"]').val($(this).closest('tr').data('user-id'));
    $('#username').val($(this).closest('tr').data('user-username'));
    $('#first_name').val($(this).closest('tr').data('user-first-name'));
    $('#last_name').val($(this).closest('tr').data('user-last-name'));
    $('#expires_on').val($(this).closest('tr').data('user-expires-on'));
    
    global.highlightRow($(this).closest('tr'));
    
});

/**
 *The add/edit user dialog has been closed
 */
$('#admin-add-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-users-table'));
});