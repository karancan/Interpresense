/**
 *Initialize datepickers
 */
$('.datepicker').datepicker({
  format: 'yyyy-mm-dd'
});

/**
 * Initialize datatables
 */
$('#admin-invoices-drafts-table').dataTable({
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