(function(){
    
    // Store a blank row with a remove button to instantiate new rows
    var $itemRow = (function() {
        var $row = $('.invoice-item-row').first().clone();
        
        // Add a remove button
        $row.children('td:first-child').html('<button type="button" class="btn btn-link btn-sm remove-invoice-item"><i class="fa fa-minus-square"></i> <span class="sr-only">Remove item</span></button>');
        
        return $row;
    }());
    
    var $fileRow = (function() {
        var $row = $('.invoice-file-row').first().clone();
        
        // Add a remove button
        $row.children('td:first-child').html('<button type="button" class="btn btn-link btn-sm remove-invoice-file"><i class="fa fa-minus-square"></i> <span class="sr-only">Remove file</span></button>');
        
        return $row;
    }());
    
    function generateItemRow($row) {
        var $newRow = $row.clone();
        
        // Init datepicker on cloned row
        $('.invoice-item-date', $newRow).datepicker({
            format: 'yyyy-mm-dd'
        });
        
        return $newRow;
    }
    
    /**
     * Change the styling of an input to a negative state
     * @param {$} element An input element
     */
    function showInputFailure(element) {
        element.parent().removeClass('has-success').addClass('has-error');
    }

    /**
     * Change the styling of an input to a positive state
     * @param {$} element An input element
     */
    function showInputSuccess(element) {
        element.parent().removeClass('has-error').addClass('has-success');
    }

    /**
     * Calculates the amount based on hours and rate
     * @param {$} $row The input item row
     */
    function calculateAmount($row) {
        var hours, amount;

        hours = (parseInt($('.invoice-item-hours', $row).text(), 10) + parseInt($('.invoice-item-minutes', $row).text(), 10)/60),
        amount = (hours * parseFloat($('.invoice-item-rate', $row).val())).toFixed(2);

        if(isNaN(amount)) {
            amount = '0.00';
        }

        $('.invoice-item-amounts', $row).text(amount);

        totalAmounts();
    }

    /**
     * Calculates the total amount of the invoice
     */
    function totalAmounts() {
        //Update the total of all invoice items
        var total_amount = $('.invoice-item-amounts').toArray().reduce(function(p, v) {
            return p += parseFloat(v.textContent);
        }, 0);

        $('#invoice-total-dollar-amount').text('$' + total_amount.toFixed(2));
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
     * Invoke tooltip popovers
     */
    $("[data-popover='true']").popover({
        container: 'body',
        trigger: 'hover'
    });
    
    $('.add-invoice-item').click(function() {
        $('.invoice-item-row').last().after(generateItemRow($itemRow));
    });
    
    $('.add-invoice-file').click(function() {
        $('.invoice-file-row').last().after($fileRow.clone());
    });

    /**
     * Delete a row
     */
    $('.invoice-table').on('click', '.remove-invoice-item', function() {
        $(this).closest('tr').remove();
    });
    
    $('.invoice-files-table').on('click', '.remove-invoice-file', function() {
        $(this).closest('tr').remove();
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
        $('#mode').val('draft');
        alert("Draft will be saved...you will receive an email");
    });

    /**
     *User wants to submit the invoice
     */
    $('#invoice_form').submit(function(){
        $('#mode').val('final');

        if (this.checkValidity()) {
            alert("Invoice will be submitted...you will receive an email");
        }
    });

    /**
     * User is entering information into the form
     */
    $('#invoice_form').on('blur change', 'input, select', function() {
        'use strict';

        //Update the fields' UI state
        if(!this.checkValidity()) {
            showInputFailure($(this));
        } else {
            showInputSuccess($(this));
        }
    });
}());