$(document).ready(function() {
    showhideDoBR(); //Date of Bill Requested 
    $('#date_range_bills_liens_c').attr('onchange','showhideDoBR();'); //Call onchange function
});

function showhideDoBR(){
	//removeFromValidate('EditView','date_requested');
        $('#date_requested').parent().parent().parent().hide();
	var date_range = $('#date_range_bills_liens_c').val();
     if(date_range == 'Updated_Bill_From_specific_date'){
        $('#date_requested').parent().parent().parent().show();
        $('#date_requested').parent().css('float','right');
        $('#date_requested').parent().css('width','70%');
        $('#date_requested').css('width','70%');
	addToValidate('EditView','date_requested', 'date',true, 'Date of Bill Requested up through today:' );
        }
}

