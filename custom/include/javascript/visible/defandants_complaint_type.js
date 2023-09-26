/* 
$(document).ready(function() {
	showhidedefsFields();
	 $("#complaint_type_c").change(function() {
        showhidedefsFields(); //Call hide/show function
	});
});

function showhidedefsFields(){
	console.log('sasd');
	var complaint_type = document.getElementsByName('complaint_type_c')[0].value;
	if(complaint_type.includes("Multiple"))
	{
		$('#date_of_incident').parent().parent().parent().show();
	}
	else {
		$('#date_of_incident').parent().parent().parent().hide();
	}
      
} */



