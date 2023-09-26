function initCliInsComplaintType(){
    showhideCliInsFields();
    changeCliInsFields(); //Call onchange function
	$('#def_client_insurance_complaints_1_name').attr('onchange','showhideCliInsFields();');
	$('#def_client_insurance_complaints_1_name').attr('onblur','showhideCliInsFields();');
	$('#def_client_insurance_complaints_1complaints_ida').attr('onchange','showhideCliInsFields();');
	
	if(typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['EditView_cost_client_cost_complaints_name']) != 'undefined'){
			sqs_objects['EditView_def_client_insurance_complaints_1_name']['post_onblur_function'] = 'showhideCliInsFields';
	}
	$( "#btn_clr_def_client_insurance_complaints_1_name" ).click(function() {
		 $('div[field="companion"]').parent().hide();
		 $('div[field="number_of_ways_to_split"]').parent().hide();
	});
}
function showhideCliInsFields(collection){
	$('#complaint_type_c').closest('.edit-view-row-item').hide();
		var record_id = '';
	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		record_id = collection['name_to_value_array']['def_client_insurance_complaints_1complaints_ida'];
	}else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
		record_id = collection['id'];
	}else if($("#def_client_insurance_complaints_1complaints_ida").val() != ''){
		record_id = $("#def_client_insurance_complaints_1complaints_ida").val();
	}
	//console.log('record_id');
	//console.log(record_id);
		if(record_id != ''){
			$.ajax({
			   type: "POST",
			   url: 'index.php?module=Complaints&action=get_related_complaint_type&record='+record_id,
			   async:true,
			   data: 'sugar_body_only=1',
			   success: function(response){
					 complainttype = response;
					if(complainttype.indexOf("Companion") != -1)
					{
					   $('div[field="companion"]').parent().show();
					}
					else {
					   $('div[field="companion"]').parent().hide();
					}
					if(complainttype.indexOf("Multiple") != -1)
					{
					   $('div[field="date_of_incident"]').parent().show();
					   $('#complaint_type_c').closest('.edit-view-row-item').show();
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

function changeCliInsFields(){
     $('#btn_def_client_insurance_complaints_1_name').focus(function() {
            // console.log(complainttype);
        showhideCliInsFields(); //Call hide/show function
    });
}
$(document).ready(function() {
        initCliInsComplaintType();
})
