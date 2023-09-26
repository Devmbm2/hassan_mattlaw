
$(document).ready(function(){
	if (typeof formName === "undefined") {
		formName = 'CalendarEditView';
		redirect = 0;
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
});

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
	$('.container-close').trigger('click');
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
			return_value = true;
		}
	}else{
			return_value = true;
	}
	$.LoadingOverlay("hide");
	return return_value; // to stay on the page
}


function SendSelectedOptionResetCancell(){
		var select_cancelled_reset_c = $("input[name='select_cancelled_reset_c']:checked").val();
		if(select_cancelled_reset_c == 'mark_cancell_close'){
			$('#cancelled_reset_c').val('Cancelled');			
		}
		$('.container-close').trigger('click');
		var _form = document.getElementById(formName); 
		if(redirect){
			_form.return_module.value='Calendar';
			_form.return_action.value='index';
		}
		_form.module.value='FP_events';_form.action.value='Save'; if(check_form(formName))SUGAR.ajaxUI.submitForm(_form);return false;
	
}
/*$(document).on('change','#event_type',function(){
  var event_type= $( "#event_type option:selected" ).val();
  var record_id = $("[name='record']").val();
  // if(record_id) {
	$.LoadingOverlay("show", {zIndex: 999999 } );
	      console.log("here");   
	$.ajax({
		url: 'index.php?module=FP_events&action=show_related_workflows&event_type='+event_type+'&record_id='+record_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			if(event_type!="" && result){ 

				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active'});
				$.LoadingOverlay("hide");
			}
			$.LoadingOverlay("hide");
		}

	});
// }
});

function activate_workflows(){

		var record_id = $("[name='record']").val();
    var get_ids = [];
    $.each($("input[name='workflow_related']:checked"), function(){
        get_ids.push($(this).val());
    });

		$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
			url: 'index.php?module=FP_events&action=activate_related_workflows&get_ids='+get_ids+'&record_id='+record_id,
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'text',
			data: 'sugar_body_only=true',						
			async: true,			
			success : function (data){   
   				YAHOO.SUGAR.MessageBox.show({
          msg: data,
          height: '500px',
          width: '300px',
          position: 'centre',
          title: 'Success',
        	


      });
        	$.LoadingOverlay("hide");
			}
		});	
}

function ShowDescription(description){
 $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Description</div>
 <div class="bd">
 <div class="container " style="width: 400px; font-size:15px; background-color:white; ">
<div style="padding:5%;">`+description+`</div></div></div> </div>`);
}

function ClosePopup(e){
 $($(e).parent()[0]).remove();
}
function cancelWorkflow(){
  var _form = 
document.getElementById('EditView');
_form.action.value='Save'; 
if(check_form('EditView')){
SUGAR.ajaxUI.submitForm(_form);
return false;
}
}
function confirm_activate_workflows(){
	 var get_ids = [];
            $.each($("input[name='workflow_related']:checked"), function(){
                get_ids.push($(this).val());
            });
	$.ajax({
		url: 'index.php?module=FP_events&action=show_confirm_workflows&get_ids='+get_ids,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
         $('#sugarMsgWindow_c').append(`
				 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
				 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
				 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Confirmation</div>
				 <div class="bd">
				 `+result+`
				 <div class="container " style="width: 600px; font-size:15px; background-color:white; ">
				<hr>
				<div>
				 <p>Do you want to activate selected workflow ? </p>
				 <br>
				 <div style="padding-bottom:45px;">
				 <input title="No" accesskey="a" class="button primary" onclick="ClosePopup_confirm(this);" type="submit" name="button" value="No" id="popup_confirm_close"  style="float:right; border-radius:20px; ">
				 <input title="Yes" accesskey="a" class="button primary" onclick="activate_workflows();" type="submit" name="button" value="Yes" style="float:right; border-radius:20px; ">
				</div>
				</div>
      </div>
         </div>
 </div>`);      
		}
		});
}
function ClosePopup_confirm(e){
   
 $($(e).parent().parent().parent().parent().parent()[0]).remove();
  
}

function activate_workflows(){
    var get_ids = [];
    $.each($("input[name='workflow_related']:checked"), function(){
        get_ids.push($(this).val());
    });
		$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
			url: 'index.php?module=FP_events&action=activate_related_workflows&get_ids='+get_ids,
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'text',
			data: 'sugar_body_only=true',						
			async: true,			
			success : function (data){ 
        YAHOO.SUGAR.MessageBox.show({
          msg: data,
          height: '500px',
          width: '300px',
          position: 'centre',
          title: 'Success',
      });
        	$.LoadingOverlay("hide");
			}
		});	
}*/
function remove_attachment(id){
  if(id){
      $.ajax({
        type: 'POST',
        url: 'index.php?module=FP_events&action=removeAttachment&note_id='+ id,
        async: false,
        success: function(response){
          console.log("remove");
        }
      });
  }
}