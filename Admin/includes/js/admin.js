/**
 *The user changes one of the date filters
 */
$('.admin-page-filter-input').change(function(){
    
    //We first save the new value to localStorage
    localStorage.setItem($(this).prop('id'), $(this).val());
    
    $(this).closest('form').submit();
});