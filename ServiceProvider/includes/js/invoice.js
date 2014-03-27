/**
User wants to clear the form
**/
$('#invoice-btn-clear').click(function(){
    var double_check = confirm("Are you sure you want to clear this form?");
    if(double_check){
        //TODO: clear form
    }
});

/**
User wants to save a draft
**/
$('#invoice-btn-draft').click(function(){
    alert("Draft will be saved...you will receive an email");
});

/**
User wants to submit the invoice
**/
$('#invoice-btn-submit').click(function(){
    alert("Invoice will be submitted...you will receive an email");
});