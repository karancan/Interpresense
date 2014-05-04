/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-invoice-id="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-invoice-id="' + focus + '"]').offset().top
        }, 1000);
    }
});

/**
 *User wants to view invoice items
 */
$('[data-action="view-items"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: loader
    
    var controller = window.location.href.replace(/^.*\//, "").replace(/\?.*$/, "");
    
    $.ajax({
        type: 'post',
        url: controller + '?page=fetch-invoice-items',
        data: {
            invoice_id: $(this).closest('tr').data('invoice-id')
        }
    }).done(function() {
        //@todo: handle response
    });
});

/**
 *User wants to view invoice files
 */
$('[data-action="view-files"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: loader
    
    var controller = window.location.href.replace(/^.*\//, "").replace(/\?.*$/, "");
    
    $.ajax({
        type: 'post',
        url: controller + '?page=fetch-invoice-files',
        data: {
            invoice_id: $(this).closest('tr').data('invoice-id')
        }
    }).done(function() {
        //@todo: handle response
    });
});

/**
 *User wants to view invoice notes
 */
$('[data-action="view-notes"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: loader
    
    $('#admin-invoice-notes-table tbody').html('');
    var controller = window.location.href.replace(/^.*\//, "").replace(/\?.*$/, "");
    
    $.ajax({
        type: 'post',
        url: controller + '?page=fetch-invoice-notes',
        data: {
            invoice_id: $(this).closest('tr').data('invoice-id')
        }
    }).done(function(data) {
        
        var markup = '';
        
        if (data.length < 1){
            markup = '<tr><td colspan="3" class="empty-table-placeholder">There are no notes for this invoice…</td></tr>';
        } else {
            for (i=0; i<data.length; i++){
                markup += '<tr  data-note-id="' + data[i].note_id + '">';
                markup += '<td>' + data[i].emp_name + '</td>';
                markup += '<td>' + data[i].note + '</td>';
                markup += '<td>' + data[i].inserted_on + '</td>';
                markup += '</tr>';
            }
        }
        $('#admin-invoice-notes-table tbody').html(markup);
    });
});

/**
 *User wants to view invoice service provider details
 */
$('[data-action="view-sp-details"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    $('#invoice_sp_name').html($(this).closest('tr').data('sp-name') + ' <a target="_blank" href="search.php?q=' + encodeURIComponent($(this).closest('tr').data('sp-name')) + '">(Search for all invoices by this service provider)</a>');
    $('#invoice_sp_address').text($(this).closest('tr').data('sp-address'));
    $('#invoice_sp_postal_code').text($(this).closest('tr').data('sp-postal-code'));
    $('#invoice_sp_city_province').text($(this).closest('tr').data('sp-city') + ', ' + $(this).closest('tr').data('sp-province'));
    $('#invoice_sp_phone').text($(this).closest('tr').data('sp-phone'));
    $('#invoice_sp_hst_number').text($(this).closest('tr').data('sp-hst-number'));
    $('#invoice_sp_email').html('<a href="mailto:' + $(this).closest('tr').data('sp-email') + '">' + $(this).closest('tr').data('sp-email') + '</a>');
});

/**
 *One of the following modals has been closed: {view files, view items, view notes, view SP details}
 */
$('#admin-invoice-items-modal, #admin-invoice-files-modal, #admin-invoice-notes-modal, #admin-invoice-sp-details-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('.invoice-table'));
});