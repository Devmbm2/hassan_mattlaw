/* 
$(document).ready(function() {
	showhidedefsFields();
	 $("#case_type_c").change(function() {
        showhidedefsFields(); //Call hide/show function
	});
});

function showhidedefsFields(){
	console.log('sasd');
	var case_type = document.getElementsByName('case_type_c')[0].value;
	if(case_type.includes("Multiple"))
	{
		$('#date_of_incident').parent().parent().parent().show();
	}
	else {
		$('#date_of_incident').parent().parent().parent().hide();
	}
      
} */



