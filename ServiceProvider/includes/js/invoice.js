/**
User wants to clear the form
*/
$('#invoice-btn-clear').click(function(){
    var double_check = confirm("Are you sure you want to clear this form?");
    if(double_check){
        window.location.reload(true);
    }
});

/**
User wants to save a draft
*/
$('#invoice-btn-draft').click(function(){
    alert("Draft will be saved...you will receive an email");
});

/**
User wants to submit the invoice
*/
$('#invoice-btn-submit').click(function(){
    alert("Invoice will be submitted...you will receive an email");
});

/**
User is entering information in to the input fields in invoice rows
*/
$(document).on('input focusout', '.invoice-item-input', function(){

    //Update the fields' UI state
    if($(this).val() === ""){
        showInputFailure($(this));
        all_complete = false;
    }
    else{
        showInputSuccess($(this));
    }
    
    //Check to see if all the fields in the row have been completed
    var all_complete = true;
    $(this).closest('tr').find('.invoice-item-input').each(function(){
        if($(this).val() === ""){
            all_complete = false;
        }
    });
    
    //If all fields have been completed, we can add a new row
    if (all_complete){
        var tr = $(this).closest('tr');
        var clone = tr.clone();
        clone.find('.invoice-item-input').val('');
        tr.after(clone);
    }
    
    //Update the total of all invoice items
    var total_amount = 0;
    $('.invoice-item-amounts').each(function(){
        total_amount = total_amount + parseInt($(this).text(), 10);
    });
    $('#invoice-total-dollar-amount').text('$' + total_amount.toFixed(2));
    
});

function showInputFailure(element){
    element.closest('td').removeClass('has-success').addClass('has-error');
}

function showInputSuccess(element){
    element.closest('td').removeClass('has-error').addClass('has-success');
}