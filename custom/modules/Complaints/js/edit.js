$(document).ready(function(){
	$('#contact_id_c').attr('onchange','updateRelatedContactFields();');	
	$('#judge_c').attr('onblur','updateRelatedContactFields();');
});

function updateRelatedContactFields(collection){
		var related_id = '';
		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			related_id = collection['name_to_value_array']['contact_id_c'];
		}
		else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
			related_id = collection['id'];
		}else if($('#contact_id_c').val() != ''){
			related_id = $('#contact_id_c').val();
		}
		if(related_id != ''){
			$.ajax({
				type: 'POST',
				url: 'index.php?module=Complaints&action=getRelatedContactFields&related_id='+related_id,
				async: false,
				success: function(response){
				console.log(response);
				var obj = JSON.parse(response);
				console.log('run');
				console.log(obj);
				$('#judge_assistant_c').val(obj.judge_assistant_c);     
				$('#judge_asst_phone_c').val(obj.judge_asst_phone_c);      
				$('#judge_web_page_c').val(obj.judge_web_page_c);     
				$('#judge_asst_email_c').val(obj.judge_asst_email_c);
			}
			});
		}

		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
		}
}