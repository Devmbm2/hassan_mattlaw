$(document).ready(function() {
    showhideCompanion();
	 $("#case_type_c").change(function() {
        showhideCompanion(); //Call hide/show function
	});
});


function showhideCompanion(){
	$('#case_type_c').parent().parent().hide();
	$('#companion_c').parent().parent().hide();
	var case_type = $('#case_type_c').val();
	if(typeof(case_type) !==  'undefined'){
		if(case_type.includes("Companion"))
		{
			 $('#companion_c').parent().parent().show();
		}
		else {
			$('#companion_c').parent().parent().hide();

		}  
	}
}



