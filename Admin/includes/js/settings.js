/**
 *User wants to add a setting
 */
$('[data-action="add"]').click(function(){
    
    $('#admin-add-setting-modal .modal-title').text('Add setting');
    $('#setting_name, #setting_value').val('');
    // @todo: vdiep....add row highlighting
    
});

/**
 *User wants to edit a setting
 */
$('[data-action="edit"]').click(function(){
    
    $('#admin-add-setting-modal .modal-title').text('Edit setting');
    $('#setting_name').val($(this).closest('tr').data('setting-key'));
    var setting_value = $(this).closest('tr').data('setting-value');
    if (typeof setting_value === 'object') {
        //@todo: handling of JSON values which typically apply to multi-language values
    }
    $('#setting_value').val($(this).closest('tr').data('setting-value'));
    
    // @todo: vdiep....add row highlighting
    
});

/**
 *User wants to delete a setting
 */
$('[data-action="delete"]').click(function(){

    // @todo: vdiep....add row highlighting
    
    if(confirm("Are you sure you want to delete this setting? This action is not reversible and could cause the application to malfunction.")){
        $.ajax({
            type: 'post',
            url: 'settings.php?page=delete-setting',
            data: 'key=' + $(this).closest('tr').data('setting-key'),
            success: function(){
                window.location.href = 'settings.php';
            }
        });
    }
});