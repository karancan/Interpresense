/**
 * Change the styling of an input to a negative state
 * @param {$} element An input element
 */
function showInputFailure(element) {
    element.closest('td').removeClass('has-success').addClass('has-error');
}

/**
 * Change the styling of an input to a positive state
 * @param {$} element An input element
 */
function showInputSuccess(element) {
    element.closest('td').removeClass('has-error').addClass('has-success');
}

/**
 * Calculates the amount based on hours and rate
 * @param {$} $row The input item row
 */
function calculateAmount($row) {
    var hours, amount;
            
    hours = (parseInt($('.invoice-item-hours', $row).text(), 10) + parseInt($('.invoice-item-minutes', $row).text(), 10)/60),
    amount = (hours * parseInt($('.invoice-item-rate', $row).val(), 10)).toFixed(2);
    
    if(isNaN(amount)) {
        amount = '0.00';
    }
    
    $('.invoice-item-amounts', $row).text(amount);
}

$('.invoice-item-date').datepicker({
    format: 'yyyy-mm-dd'
});

$('.invoice-item-start-time, .invoice-item-end-time').change(function(){
    var $thisRow = $(this).closest(".invoice-item-row"),
        date = $('.invoice-item-date', $thisRow).val() || '2014-05-01',
        startTime = new Date(date + 'T' + $('.invoice-item-start-time', $thisRow).val()),
        endTime = new Date(date + 'T' + $('.invoice-item-end-time', $thisRow).val()),
        diffInMinutes = (endTime.getTime() - startTime.getTime()) / 1000 / 60;
    
    // Verify validity
    if(startTime > endTime) {
        showInputFailure($('.invoice-item-start-time', $thisRow));
        showInputFailure($('.invoice-item-end-time', $thisRow));
    } else {
        showInputSuccess($('.invoice-item-start-time', $thisRow));
        showInputSuccess($('.invoice-item-end-time', $thisRow));
    }
    
    // Update hours
    $('.invoice-item-hours', $thisRow).text(Math[(diffInMinutes / 60) < 0 ? 'ceil' : 'floor'](diffInMinutes / 60));
    $('.invoice-item-minutes', $thisRow).text(diffInMinutes % 60);
    
    // Calculate amount
    calculateAmount($thisRow);
});

$('.invoice-item-rate').change(function(){
    'use strict';
    var $thisRow = $(this).closest(".invoice-item-row");
    if(this.checkValidity()) {
        calculateAmount($thisRow);
    }
});

/**
 *User wants to clear the form
 */
$('#invoice-btn-clear').click(function(){
    if(confirm("Are you sure you want to clear this form?")){
        window.location.reload(true);
    }
});

/**
 *User wants to save a draft
 */
$('#invoice-btn-draft').click(function(){
    alert("Draft will be saved...you will receive an email");
});

/**
 *User wants to submit the invoice
 */
$('#invoice-btn-submit').click(function(){
    alert("Invoice will be submitted...you will receive an email");
});

/**
 *User is entering information in to the input fields in invoice rows
 */
$(document).on('input focusout', '.invoice-item-input', function() {
    var $thisRow = $(this).closest(".invoice-item-row");

    //Update the fields' UI state
    if(!this.checkValidity()) {
        showInputFailure($(this));
    } else {
        showInputSuccess($(this));
    }

    if (!$thisRow.next("tr").length) {
        //Variable determining if all the fields in a row are succesfully completed.
        //Check to see if no fields in the row are incomplete or erroneous
        var all_complete = !$thisRow.find('.invoice-item-input').filter(function(){
            return $(this).hasClass("has-error") || !this.checkValidity();
        }).length;

        //If all fields have been completed, we can add a new row
        if (all_complete) {
            var $clone = $thisRow.clone();
            $clone.find('.invoice-item-input').val('');
            $clone.find('.has-success').each(function() {
                $(this).removeClass("has-success");
            });
            $thisRow.after($clone);
        }

        //Update the total of all invoice items
        var total_amount = 0;
        $('.invoice-item-amounts').each(function() {
            total_amount += parseInt($(this).text(), 10);
        });

        $('#invoice-total-dollar-amount').text('$' + total_amount.toFixed(2));
    }

});