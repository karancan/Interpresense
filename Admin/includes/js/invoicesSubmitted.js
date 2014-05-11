/**
 *User wants to mark an invoice as approved
 */
$('[data-action="approve-invoice"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm("Are you sure you want to mark this invoice as approved? This action cannot be undone.")){
        window.location.href = $(this).data('href');
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
    
});