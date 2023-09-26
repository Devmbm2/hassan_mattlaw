var splitNumber = function(){
var no_of_split = $('#number_of_ways_to_split').val();
if(no_of_split>0)
{
	$("#companion").parent().parent().show();
}
else
{
	$("#companion").parent().parent().hide();
}
}
$('select[name="type"]').change(function() {

	var selected_type_option=$("select[name='type'] option:selected").text();
	if(jQuery('#parent_name').attr('name'))
		// if($("#parent_name").attr("name","parent_name"))
	{
		var selected_payee_text=$("#parent_name").val();
		$("#document_name").val(selected_type_option+'-'+selected_payee_text)	
	}
	else{
		var selected_payee_text_payee=$("#payee").val();
		$("#document_name").val(selected_type_option+'-'+selected_payee_text_payee)
	}

});

$(document).on('focusout','#parent_name',function(event){
	var selected_payee_text=$("#parent_name").val();
	var selected_type_option=$("select[name='type'] option:selected").text();
	console.log(selected_payee_text);
	$("#document_name").val(selected_type_option+'-'+selected_payee_text);
});


$(document).on('focusout','#payee',function(event){
	var selected_payee_text=$("#payee").val();
	var selected_type_option=$("select[name='type'] option:selected").text();
	console.log(selected_payee_text);
		$("#document_name").val(selected_type_option+'-'+selected_payee_text);
});

$(document).ready(function(){
	//checkClientCost();
	recoveredPartiallyPaid();
	$('input[type=radio][name=recovery_of_costs]').change(function() {
		recoveredPartiallyPaid();
	});

	$("#companion").parent().parent().hide();
	$("#document_name").attr('readonly',true);
	$("#document_name").attr('placeholder','This is read only field fills basis of TYPE-PAYEE');
});
$("#number_of_ways_to_split").on('change', splitNumber);
$(document).ready(splitNumber);
document.getElementById("lost_money").setAttribute("onkeypress", "return isNumberKey(event)");

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
	$('#lost_unreimbursed_costs').parent().parent().hide();
	$('#lost_money').parent().parent().hide();
	$('#lost_money_date').parent().parent().parent().hide();
	var recovery_of_costs = $('input[name="recovery_of_costs"]:checked').val();
	if (recovery_of_costs == 'recovered_and_partially_paid') {
		$('#lost_unreimbursed_costs').parent().parent().show();
		//addToValidate('EditView','lost_unreimbursed_costs','varchar',true,'Lost and Unreimbursed Costs');
		if(typeof required_fields !== "undefined"){
			required_fields['lost_unreimbursed_costs'] = 'Lost and Unreimbursed Costs';
		}
	} else if (recovery_of_costs == 'dollar_amount_of_lost_and_unreimbursed_cost')
	{
		$('#lost_money').parent().parent().show();
		$('#lost_money_date').parent().parent().parent().show();
		if(typeof required_fields !== "undefined"){
			required_fields['lost_money'] = 'Lost Money';
		}
         
	}else{
		$('#lost_unreimbursed_costs').parent().parent().hide();
		$('#lost_money').parent().parent().hide();
		//removeFromValidate('EditView','lost_unreimbursed_costs');
		if(typeof required_fields !== "undefined"){
			delete required_fields['lost_unreimbursed_costs'];
		}
		if(typeof required_fields !== "undefined"){
			delete required_fields['lost_money'];
		}
	}	
}


function isNumberKey(evt)
{
     
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
	  && (charCode < 48 || charCode > 57))
	   return false;

	return true;
}