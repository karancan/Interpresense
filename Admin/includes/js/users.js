/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-user-id="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-user-id="' + focus + '"]').offset().top
        }, 1000);
    }
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