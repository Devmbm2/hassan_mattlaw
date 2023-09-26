
$(document).ready(function(){
	if (typeof formName === "undefined") {
		formName = 'CalendarEditView';
	}
	$('#parent_id').attr('onchange','updateRelatedAddress();');	
	$('#parent_name').attr('onblur','updateRelatedAddress();');	
	$('#parent_name').attr('onchange','updateRelatedAddress();');
	$('#cases_fp_events_1cases_ida').attr('onchange','updateRelatedAssignedTo();');	
	$('#cases_fp_events_1_name').attr('onblur','updateRelatedAssignedTo();');	
	$('#cases_fp_events_1_name').attr('onchange','updateRelatedAssignedTo();');
	 YAHOO.util.Event.addListener(
      "parent_id",
      "change",
      function() {
        $("#btn_parent_name").attr(
          "onclick",
          "openLocationPopup()"
          );
		   updateRelatedAddress();
		}
      );
	OnclickCancelResetFunction();	

});
function OnclickCancelResetFunction(){
	
	$( "#SAVE_EVENT" ).click(function() {
	  check_cancel_reset();
	});
}

function openLocationPopup(){
    if ($("#parent_id")) {
		open_popup(
			document.EditView.parent_type.value,
			600,
			400,
			"", 
			true, 
			false,
			{"call_back_function":"set_return",
				"form_name":"EditView",
				"field_to_name_array":{
				"id":"parent_id",
				"name":"parent_name"}
			},
			"single",
			true
		);
		
    }
}
function updateRelatedAddress(){
	var related_id = $('#parent_id').val();
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=FP_events&action=getRelatedAddress&related_id='+related_id+'&related_type='+$('#parent_type').val(),
			async: false,
			success: function(response){
			var obj = JSON.parse(response);
			$('#primary_address_street').val(obj.primary_address_street);     
			$('#location_address_city_c').val(obj.location_address_city_c);      
			$('#location_address_state_c').val(obj.location_address_state_c);     
			$('#location_address_postalcode_c').val(obj.location_address_postalcode_c);
			$('#phone_at_location_of_event_c').val(obj.phone_at_location_of_event_c);
		}
		});
	}
}

function updateRelatedAssignedTo(collection){
	var related_id = '';
	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		related_id = collection['name_to_value_array']['cases_fp_events_1cases_ida'];
	}else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
		related_id = collection['id'];
	}else if($("#cases_fp_events_1cases_ida").val() != ''){
		related_id = $("#cases_fp_events_1cases_ida").val();
	}
	console.log('related_id');
	console.log(related_id);
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=FP_events&action=getRelatedAssignedTo&related_id='+related_id,
			async: false,
			success: function(response){
				console.log('response');
				console.log(response);
				console.log(formName);
				if(response != ''){
					$('#'+ formName + " #multiple_assigned_users  option:selected").removeAttr("selected");
					$('#'+ formName + " #multiple_assigned_users").multiselect( 'reset' );
					$('#'+ formName + " #multiple_assigned_users option[value='"+ response +"']").attr('selected', 'selected');
					$('#'+ formName + " #multiple_assigned_users").multiselect( 'reset' );
				}
			}
		});
	}
	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	}
}

function check_cancel_reset(){
	var cancelled_reset_c = $('#cancelled_reset_c').val();
	var  return_value = true;
	var record_id = document.getElementsByName("record")[0].value;
	if(record_id != ''){
		if(cancelled_reset_c == 'Reset'){
			$.LoadingOverlay("show", {zIndex: 999999 } );
			$.ajax({
				url: 'index.php?module=FP_events&action=check_cancel_reset_screen',
				type: 'POST',
				contentType: 'application/x-www-form-urlencoded',
				dataType: 'text',
				data: 'sugar_body_only=true',						
				async: false,			
				success : function (result){
					return_value = false;
						YAHOO.SUGAR.MessageBox.show({msg: result, height:'300px', width:'100px',title: 'Function for Events'});
						$.LoadingOverlay("hide");
				}
			});
		}else{
			var _form1 = document.getElementById(formName);
			/* if(redirect == 1){
				_form1.return_module.value='Calendar';
				_form1.return_action.value='index';
			} */
			_form1.action.value='Save'; if(check_form(formName))SUGAR.ajaxUI.submitForm(_form1);return false;
		}
	}else{
		/* if(cancelled_reset_c != 'Reset'){ */
			var _form1 = document.getElementById(formName); 
			/* if(redirect){
				_form1.return_module.value='Calendar';
				_form1.return_action.value='index';
			} */
			_form1.action.value='Save'; if(check_form(formName))SUGAR.ajaxUI.submitForm(_form1);return false;
		/* } */
	}
	return return_value; // to stay on the page
}

function SendSelectedOptionResetCancell(){
	var select_cancelled_reset_c = $("input[name='select_cancelled_reset_c']:checked").val();
	var record_id= document.getElementsByName("record")[0].value;
	if(select_cancelled_reset_c == 'mark_cancell_close'){
		$('#cancelled_reset_c').val('Cancelled');
		$('.container-close').trigger('click');
		var _form1 = document.getElementById(formName); 
		if(redirect){
			_form1.return_module.value='Calendar';
			_form1.return_action.value='index';
		}
		_form1.action.value='Save'; if(check_form(formName))SUGAR.ajaxUI.submitForm(_form1);return false;
	}else if(select_cancelled_reset_c == 'mark_cancell_duplicate'){
			$.ajax({
				url: 'index.php?module=FP_events&action=update_event_name_cancelled&record_id='+record_id,
				type: 'POST',
				contentType: 'application/x-www-form-urlencoded',
				dataType: 'text',
				data: 'sugar_body_only=true',						
				async: false,			
				success : function (result){
					
				}
			});
		var _form2 = document.getElementById(formName); 
		_form2.return_module.value='FP_events';
		if(redirect){
			_form2.return_module.value='Calendar';
			_form2.return_action.value='index';
		}
		_form2.isDuplicate.value=true; 
		_form2.action.value=formName;
		if(check_form(_form2))SUGAR.ajaxUI.submitForm(_form2);return false;
	}
}


