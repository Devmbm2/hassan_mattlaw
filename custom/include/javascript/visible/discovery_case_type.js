$(document).ready(function() {
 showhideDiscFields();
    $('#disc_discovery_cases_name').attr('onchange','showhideDiscFields();');
	$('#disc_discovery_cases_name').attr('onblur','showhideDiscFields();');
	$('#disc_discovery_casescases_ida').attr('onchange','showhideDiscFields();');
	
	if(typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['EditView_disc_discovery_cases_name']) != 'undefined'){
			sqs_objects['EditView_disc_discovery_cases_name']['post_onblur_function'] = 'showhideDiscFields';
	}
	$( "#btn_clr_disc_discovery_cases_name" ).click(function() {
		 $('div[field="companion"]').parent().hide();
	});


});

function showhideDiscFields(collection){
		var record_id = '';
		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			record_id = collection['name_to_value_array']['disc_discovery_casescases_ida'];
		}else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
			record_id = collection['id'];
		}else if($("#disc_discovery_casescases_ida").val() != ''){
			record_id = $("#disc_discovery_casescases_ida").val();
		}
		console.log('record_id');
		console.log(record_id);
		if(record_id != ''){
			$.ajax({
			   type: "POST",
			   url: 'index.php?module=Cases&action=get_related_case_type&record='+record_id,
			   async:true,
			   data: 'sugar_body_only=1',
			   success: function(response){
					 casetype = response;
					console.log(casetype);
					if(casetype.indexOf("Companion") != -1)
					{
						console.log('yes');
						$('div[field="companion"]').parent().show();
					}
					else {
					
					   $('div[field="companion"]').parent().hide();
					}
					if(casetype == "Multiple Claims in One")
					{
				
					   $('div[field="date_of_incident"]').parent().show();
					}
					else {
					   
					   $('div[field="date_of_incident"]').parent().hide();
					}
				}
			});
		}else{
		   $('div[field="date_of_incident"]').parent().hide();
		   $('div[field="companion"]').parent().hide();
		}
		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			set_return(collection);
		}
      
}