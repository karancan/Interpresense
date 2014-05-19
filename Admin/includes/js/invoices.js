/**
 *Actions that take place after page load
 */
$(document).ready(function(){

    //If a row needs to be focussed on, we highlight it
    if (focus !== ''){
        global.highlightRow($('[data-invoice-id="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-invoice-id="' + focus + '"]').offset().top
        }, 1000);
    }
    
    //Apend `start` and `end` paramters to add invoice notes form
    $('#admin-invoice-add-notes-form').attr('action', $('#admin-invoice-add-notes-form').attr('action') + '&start=' + $('.admin-page-filter-input[name="start"]').val() + '&end=' + $('.admin-page-filter-input[name="end"]').val());
});

/**
 *User wants to view invoice items
 */
$('[data-action="view-items"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    $('#admin-invoice-items-loader').show();
    
    $('#admin-invoice-items-table tbody, #admin-invoice-grand-total, #admin-invoice-last-viewed').html('');
    $('#admin-invoice-mark-as-unread').data('invoice-id', $(this).closest('tr').data('invoice-id')).hide();
    var controller = window.location.pathname.replace(/^.*\//, '');
    
    $.ajax({
        type: 'post',
        url: controller + '?page=fetch-invoice-items',
        data: {
            invoice_id: $(this).closest('tr').data('invoice-id')
        }
    }).done(function(data) {
        
        var items = data.items;
        var grand_total = data.grand_total;
        var viewed = data.viewed;
        
        var markup = '';
        
        if (items.length < 1){
            markup = '<tr><td colspan="9" class="empty-table-placeholder">There are no items for this invoice…</td></tr>';
        } else {
            for (var i=0; i<items.length; i++){
                markup += '<tr>';
                markup += '<td>' + items[i].inserted_on + '</td>';
                markup += '<td>' + items[i].activity_name_en + '</td>';
                markup += '<td>' + items[i].description + '</td>';
                markup += '<td>' + items[i].course_code + '</td>';
                markup += '<td>' + items[i].service_date + '</td>';
                markup += '<td>' + items[i].start_time + '</td>';
                markup += '<td>' + items[i].end_time + '</td>';
                markup += '<td>' + items[i].rate + '</td>';
                markup += '<td><strong>' + items[i].item_total + '<strong></td>';
                markup += '</tr>';
            }
        }
        $('#admin-invoice-items-table tbody').html(markup);
        $('#admin-invoice-grand-total').html(grand_total.toFixed(2));
        
        if (viewed){
            $('#admin-invoice-last-viewed').html('Last viewed by ' + viewed.name + ' on ' + viewed.admin_last_viewed_on).show();
            $('#admin-invoice-mark-as-unread').show();
        } else {
            $('#admin-invoice-last-viewed').hide();
        }
        
        $('#admin-invoice-items-loader').hide();
    });
});

/**
 *User wants to view invoice files
 */
$('[data-action="view-files"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    $('#admin-invoice-files-loader').show();
    
    $('#admin-invoice-files-table tbody').html('');
    var controller = window.location.pathname.replace(/^.*\//, '');
    
    $.ajax({
        type: 'post',
        url: controller + '?page=fetch-invoice-files',
        data: {
            invoice_id: $(this).closest('tr').data('invoice-id')
        }
    }).done(function(data) {
        
        var markup = '';
        
        if (data.length < 1){
            markup = '<tr><td colspan="3" class="empty-table-placeholder">There are no files for this invoice…</td></tr>';
        } else {
            for (var i=0; i<data.length; i++){
                markup += '<tr data-file-id="' + data[i].file_id + '">';
                markup += '<td>' + data[i].file_name + '</td>';
                markup += '<td>' + data[i].inserted_on + '</td>';
                markup += '<td class="table-option-cell"><a href="' + controller + '?page=view-file&file_id=' + data[i].file_id + '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> View file</button></td>';
                markup += '</tr>';
            }
        }
        $('#admin-invoice-files-table tbody').html(markup);
        
        $('#admin-invoice-files-loader').hide();
    });
});

/**
 *User wants to view invoice notes
 */
$('[data-action="view-notes"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    $('#admin-invoice-notes-loader').show();
    
    $('#admin-invoice-notes-table tbody').html('');
    var controller = window.location.pathname.replace(/^.*\//, '');
    
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
            for (var i=0; i<data.length; i++){
                markup += '<tr  data-note-id="' + data[i].note_id + '">';
                markup += '<td>' + data[i].emp_name + '</td>';
                markup += '<td>' + data[i].note + '</td>';
                markup += '<td>' + data[i].inserted_on + '</td>';
                markup += '</tr>';
            }
        }
        $('#admin-invoice-notes-table tbody').html(markup);
        
        $('#admin-invoice-notes-loader').hide();
    });
});

/**
 *User wants to add a note for an invoice
 */
$('[data-action="add-note"]').click(function(){
    global.highlightRow($(this).closest('tr'));
    
    $('#admin-invoice-add-notes-modal input[name="invoice_id"]').val($(this).closest('tr').data('invoice-id'));
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
 *User wants to mark an invoice as unread
 */
$('#admin-invoice-mark-as-unread').click(function(){
    
    console.log($(this).data('invoice-id'));
    
    $.ajax({
        type: 'post',
        url: 'invoicesSubmitted.php?page=mark-invoice-as-unread',
        data: {
            invoice_id: $(this).data('invoice-id')
        }
    }).done(function() {
        $('#admin-invoice-last-viewed, #admin-invoice-mark-as-unread').hide();
    });
    
});

/**
 *One of the following modals has been closed: {view files, view items, view notes, view SP details}
 */
$('#admin-invoice-items-modal, #admin-invoice-files-modal, #admin-invoice-notes-modal, #admin-invoice-add-notes-modal, #admin-invoice-sp-details-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('.invoice-table'));
});