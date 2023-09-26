$(document).ready(function() {
    showhideCompanion();
	 $("#case_type_c").change(function() {
        showhideCompanion(); //Call hide/show function
	});
});


function showhideCompanion(){
	$('#case_type_c').parent().parent().hide();
	$('#case_status_c').parent().parent().hide();
	$('#case_assigned_to_c').parent().parent().hide();
	$('#number_of_ways_to_split').parent().parent().hide();
	$('#companion').parent().parent().hide();
	var case_type = $('#case_type_c').val();
	if(case_type.includes("Companion"))
	{
		 $('#companion').parent().parent().show();
		 $('#number_of_ways_to_split').parent().parent().show();
	}
	else {
		$('#companion').parent().parent().hide();
		$('#number_of_ways_to_split').parent().parent().hide();

	}  
}



