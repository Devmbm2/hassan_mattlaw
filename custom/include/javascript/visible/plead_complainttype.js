$(document).ready(function() {
    showhideCompanion();
	 $("#complaint_type_c").change(function() {
        showhideCompanion(); //Call hide/show function
	});
});


function showhideCompanion(){
	$('#complaint_type_c').parent().parent().hide();
	$('#companion_c').parent().parent().hide();
	var complaint_type = $('#complaint_type_c').val();
	if(typeof(complaint_type) !==  'undefined'){
		if(complaint_type.includes("Companion"))
		{
			 $('#companion_c').parent().parent().show();
		}
		else {
			$('#companion_c').parent().parent().hide();

		}  
	}
}



