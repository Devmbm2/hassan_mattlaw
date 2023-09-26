$(document).ready(function() {
	showhidedefsFields();
	 $("#complaint_type_c").change(function() {
        showhidedefsFields(); //Call hide/show function
	});
});

function showhidedefsFields(){
	var complaint_type = $('#complaint_type_c').val();
	if(complaint_type.includes("Multiple"))
	{
		$('#date_of_incident').closest('.edit-view-row-item').show();
		$('#complaint_type_c').closest('.edit-view-row-item').show();
	}
	else {
		$('#date_of_incident').closest('.edit-view-row-item').hide();
		$('#complaint_type_c').closest('.edit-view-row-item').hide();
	}
      
}



