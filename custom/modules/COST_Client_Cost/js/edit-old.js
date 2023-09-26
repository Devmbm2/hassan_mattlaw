$(document).ready(function(){
	//checkClientCost();
	recoveredPartiallyPaid();
	$('input[type=radio][name=recovery_of_costs]').change(function() {
		recoveredPartiallyPaid();
	});
});

// This is requirement to hide this function for time being.

/*function checkClientCost(){
	$( "#check_number" ).change(function(){
	  if($('#check_number').val() != ''){
			$('input[value="outstanding_open_case_cost"]').prop("checked",false);
			 $('input[value="Recovered_and_paid_back_in_full"]').prop("checked",true);
	  }else{
		  $('input[value="outstanding_open_case_cost"]').prop("checked",true);
	  }
	});
}*/
function recoveredPartiallyPaid(){
	var recovery_of_costs = $('input[name="recovery_of_costs"]:checked').val();
	if (recovery_of_costs == 'recovered_and_partially_paid') {
		$('#lost_unreimbursed_costs').parent().parent().show();
		//addToValidate('EditView','lost_unreimbursed_costs','varchar',true,'Lost and Unreimbursed Costs');
		if(typeof required_fields !== "undefined"){
			required_fields['lost_unreimbursed_costs'] = 'Lost and Unreimbursed Costs';
		}
	}
	else{
		$('#lost_unreimbursed_costs').parent().parent().hide();
		//removeFromValidate('EditView','lost_unreimbursed_costs');
		if(typeof required_fields !== "undefined"){
			delete required_fields['lost_unreimbursed_costs'];
		}
	}	
}