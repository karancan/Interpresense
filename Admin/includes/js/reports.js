/**
 *User needs to be redirected to add a new template
 */
$('#redirect-add-template').click(function(){
    
    //Close the generate report modal and open the add a new template modal
    $('#admin-add-modal').modal('hide');
    $('[href="#admin-add-template-modal"]').trigger('click');
    
});