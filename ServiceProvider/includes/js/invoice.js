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
        //Check to see if all the fields in the row have been completed
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

/**
 *Change the styling of an input to a negative state
 */
function showInputFailure(element) {
    element.closest('td').removeClass('has-success').addClass('has-error');
}

/**
 *Change the styling of an input to a positive state
 */
function showInputSuccess(element) {
    element.closest('td').removeClass('has-error').addClass('has-success');
}
