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
 * Initialize popover that tells the user when the invoice was approved and by who
 */
$(".admin-invoice-approved-details").popover({
    placement: 'right',
    container: 'body',
    trigger: 'hover'
});

/**
 *User checks/unchecks the option to view approved invoices only
 */
$('#admin-filter-approved-invoices').change(function(){
    if (this.checked) {
        localStorage.setItem('interpresense_admin_invoices_submitted_approved_only', 1);
        window.location.href = 'invoicesSubmitted.php?start=' + $('.admin-page-filter-input[name="start"]').val() + '&end=' + $('.admin-page-filter-input[name="end"]').val() + '&approved_only=1';
    } else {
        localStorage.setItem('interpresense_admin_invoices_submitted_approved_only', 0);
        window.location.href = 'invoicesSubmitted.php?start=' + $('.admin-page-filter-input[name="start"]').val() + '&end=' + $('.admin-page-filter-input[name="end"]').val();
    }
});

/**
 *User wants to mark an invoice as approved
 */
$('[data-action="approve-invoice"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm("Are you sure you want to mark this invoice as approved? This action cannot be undone.")){
        window.location.href = 'invoicesSubmitted.php?page=mark-invoice-as-approved&invoice_id=' + $(this).closest('tr').data('invoice-id') +
                                                                                  '&start=' + $('.admin-page-filter-input[name="start"]').val() +
                                                                                  '&end' + $('.admin-page-filter-input[name="end"]').val() +
                                                                                  '&approved_only=' + localStorage.getItem('interpresense_admin_invoices_submitted_approved_only');
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
    
});

/**
 *User wants to edit the invoice ID for org
 */
$('[data-action="edit-invoice-id-for-org"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    var invoice_id = $(this).closest('tr').data('invoice-id');
    var invoice_id_for_org = prompt("Update organization invoice ID…", $('#admin-invoice-id-for-org-' + invoice_id).text());
    
    $.ajax({
        type: 'post',
        url: 'invoicesSubmitted.php?page=update-invoice-id-for-org',
        data: {
            invoice_id: invoice_id,
            invoice_id_for_org: invoice_id_for_org
        }
    }).done(function() {
        $('#admin-invoice-id-for-org-' + invoice_id).text((invoice_id_for_org === '' ? 'N/A' : invoice_id_for_org));
        global.removeRowHighlighting($('#admin-invoices-submitted-table'));
    });
});