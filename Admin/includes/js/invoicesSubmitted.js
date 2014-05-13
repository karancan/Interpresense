/**
 *Initialize datepickers
 */
$('.datepicker').datepicker({
  format: 'yyyy-mm-dd'
});

/**
 * Initialize datatables
 */
$('#admin-invoices-submitted-table').dataTable({
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

/**
 *User checks/unchecks the option to view approved invoices only
 */
//@todo

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