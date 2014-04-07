/**
 *User wants to add a setting
 */
$('[data-action="add"]').click(function(){
    
    $('#admin-add-setting-modal .modal-title').text('Add setting');
    
    // @todo: vdiep....add row highlighting
    
});

/**
 *User wants to edit a setting
 */
$('[data-action="edit"]').click(function(){
    
    $('#admin-add-setting-modal .modal-title').text('Edit setting');
    
    // @todo: vdiep....add row highlighting
    
});

/**
 *User wants to delete a setting
 */
$('[data-action="delete"]').click(function(){

    // @todo: vdiep....add row highlighting
    
    if(confirm("Are you sure you want to delete this setting? This action is not reversible and could cause the application to malfunction.")){
        // @todo: make ajax request
    }
});