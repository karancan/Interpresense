/**
 *The user changes one of the date filters
 */
$('.admin-page-filter-input').change(function(){
    $(this).closest('form').submit();
});