$(document).ready(function(){
	$('#contact_id_c').attr('onchange','updateRelatedContactFields();');	
	$('#judge_c').attr('onblur','updateRelatedContactFields();');
	$('#assigned_user_name').attr('onblur','updateRelatedAssignedAttorney();');
	$('#default_assistant_id').attr('onchange','updateRelatedAssignedAttorney();');
	$('#assigned_user_name').attr('onchange','updateRelatedAssignedAttorney();');
	$("#btn_default_assistant_lawyer_name").attr("onclick", "OpenPopupRelatedAssignedAttorney();");
	/* $('#default_assistant_lawyer_name').attr('onblur','SQSChangeRelatedAssignedAttorney();');
	$('#default_assistant_lawyer_name').attr('onchange','SQSChangeRelatedAssignedAttorney();'); */
	/* SQSChangeRelatedAssignedAttorney(); */
	/* updateRelatedAssignedAttorney(); */
	window.PreviousAssiendLawyerID="";
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
				url: 'index.php?module=Cases&action=getRelatedContactFields&related_id='+related_id,
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
function updateRelatedAssignedAttorney(collection){
	var related_id = '';
	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		related_id = collection['name_to_value_array']['assigned_user_id'];
	}
	else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
		related_id = collection['id'];
	}else if($('#assigned_user_id').val() != ''){
		related_id = $('#assigned_user_id').val();
	}
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=Cases&action=getRelatedAssignedAttorney&related_id='+related_id,
			async: false,
			success: function(response){
			console.log(response);
			var obj = JSON.parse(response);
			console.log('run');
			console.log(obj);
			$('#default_assistant_lawyer_name').val(obj.default_assistant_name);     
			$('#default_assistant_lawyer_id').val(obj.default_assistant_id); 
		}
		});
	}

	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	}
}
function SQSChangeRelatedAssignedAttorney(){
	sqs_objects["EditView_default_assistant_lawyer_name"].parent_id = $("#assigned_user_id").val();
}
function OpenPopupRelatedAssignedAttorney(){
    if ($("#assigned_user_id")) {
     	open_popup(
			"Users", 
			600, 
			400, 
			"&query=1&parent_id=" +
					$("#assigned_user_id").val(),
			true, 
			false, 
			{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"default_assistant_lawyer_id","name":"default_assistant_lawyer_name"}}, 
			"single", 
			true
		 );
	
    }
}
function RestrictSaveForAssiendLawyer(){
  if(window.PreviousAssiendLawyerID!=""){
        var handleYES = function() {
          this.hide();
          ChangedAllEventsRelatedToCurrentCase();
        };
        var handleNO = function() {
          this.hide();
          submitForm();
        };
        YAHOO.SUGAR.MessageBox.show({
            msg: 'Do you want to assign all event which assigned previous lawyer to this lawyer',
            height: '700px',
            width: '500px',
            position: 'centre',
            title: 'Workflows',
            buttons:[
              { text: 'Yes',handler: handleYES ,isDefault:true},
              { text: 'No',handler: handleNO ,isDefault:true},
              ]
        });
    }else{
      submitForm();
    }



}

function ChangedAllEventsRelatedToCurrentCase(){
  var value = window.PreviousAssiendLawyerID;
  var value2 = $('#assigned_user_id').val();
  var RecordID=$("input[name='record']").val();
  $.ajax({
    type: 'POST',
    url: 'index.php?module=Cases&action=UpdateAllEventsRelatedToCurrentCase',
    data:{previousLawyerID:value,currentLawyerID:value2,recordID:RecordID},
    success: function(response){
      console.log(response);
          if(response=='changedSuccfully'){
            submitForm();
          }
      }
  });
}
function submitForm(){
             var _form = document.getElementById('EditView');
            _form.action.value='Save';
            if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
}
$('#btn_assigned_user_name').click(function(){
    window.PreviousAssiendLawyerID=$('#assigned_user_id').val();
});
$('#SAVE').attr('onclick','RestrictSaveForAssiendLawyer();return false;');