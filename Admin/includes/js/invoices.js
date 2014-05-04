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
    
    //@todo: ajax
});

/**
 *User wants to view invoice files
 */
$('[data-action="view-files"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: ajax
});

/**
 *User wants to view invoice notes
 */
$('[data-action="view-notes"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: ajax
});

/**
 *User wants to view invoice service provider details
 */
$('[data-action="view-sp-details"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    //@todo: ajax
});

/**
 *One of the following modals has been closed: {view files, view items, view notes, view SP details}
 */
$('#admin-invoice-items-modal, #admin-invoice-files-modal, #admin-invoice-notes-modal, #admin-invoice-sp-details-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('.invoice-table'));
});