$(document).ready(function() {
	showhideBaseNotTyp();
	$('#notice_type').attr('onchange','pleadName();showhideBaseNotTyp();');
});
function showhideBaseNotTyp(){
	$('#filing_sub_type').parent().parent().hide();
	if(typeof required_fields !== "undefined"){
		delete required_fields['filing_sub_type'];
	}
	$('#filing_description').parent().parent().hide();
	$('#amount').parent().parent().hide();
	$('#sent_received').parent().parent().hide();
	var nottyp = document.getElementById('notice_type').value;
	if($('#category_id').val() == 'Pleading' && $('#subcategory_id').val() == 'Notice'){
		//Show/Hide Filing Sub Type
		if(nottyp == "Filing")  {
			addToValidate('EditView', 'filing_sub_type', 'enum', true, 'Filing sub type');
			if(typeof required_fields !== "undefined"){
				required_fields['filing_sub_type'] = 'Filing sub type';
			}
		   $('#filing_sub_type').parent().parent().show();
		   $('#filing_description').parent().parent().show();
		}else if(nottyp == "Serving")  {
		   $('#amount').parent().parent().show();
		   $('#sent_received').parent().parent().show();
		}	
	}
	
}
