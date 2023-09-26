$(document).ready(function() {
	showhidedefsFields();
	 $("#case_type_c").change(function() {
        showhidedefsFields(); //Call hide/show function
	});
});

function showhidedefsFields(){
	var case_type = $('#case_type_c').val();
	if(case_type.includes("Multiple"))
	{
		$('#date_of_incident').closest('.edit-view-row-item').show();
		$('#case_type_c').closest('.edit-view-row-item').show();
	}
	else {
		$('#date_of_incident').closest('.edit-view-row-item').hide();
		$('#case_type_c').closest('.edit-view-row-item').hide();
	}
      
}



