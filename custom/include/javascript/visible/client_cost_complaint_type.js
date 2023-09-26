$(document).ready(function() {
    showhideCompanion();
	 $("#complaint_type_c").change(function() {
        showhideCompanion(); //Call hide/show function
	});
});


function showhideCompanion(){
	$('#complaint_type_c').parent().parent().hide();
	$('#complaint_status_c').parent().parent().hide();
	$('#complaint_assigned_to_c').parent().parent().hide();
	$('#number_of_ways_to_split').parent().parent().hide();
	$('#companion').parent().parent().hide();
	var complaint_type = $('#complaint_type_c').val();
	if(complaint_type.includes("Companion"))
	{
		 $('#companion').parent().parent().show();
		 $('#number_of_ways_to_split').parent().parent().show();
	}
	else {
		$('#companion').parent().parent().hide();
		$('#number_of_ways_to_split').parent().parent().hide();

	}  
}



