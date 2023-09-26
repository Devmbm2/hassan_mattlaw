$(document).ready(function() {
	$("#btn_parent_name").attr("onclick", "OpenPopupDefandant();");
	showhideNegFields();
	SUGAR.util.doWhen(
		"typeof(formName) != 'undefined' && formName != ' '",
		onChangeupdateRelatedCaseAssignedTo
	);
	YAHOO.util.Event.addListener(
	"neg_negotiations_casescases_ida",
	"change",
	  function() {
		$("#btn_neg_negotiations_cases_name").attr(
		  "onclick",
		  );
		   updateRelatedCaseAssignedTo();
		   showhideNegFields();
	  }
	);
	$( "#btn_clr_neg_negotiations_cases_name" ).click(function() {
	  updateRelatedCaseAssignedToClear();
	});
});
function openCasePopup(){
    if ($("#neg_negotiations_casescases_ida")) {
		open_popup(
			"Cases", 
			600, 
			400, 
			"", 
			true, 
			false, 
			{"call_back_function":"set_return",
			"form_name":"EditView",
			"field_to_name_array":{"id":"neg_negotiations_casescases_ida",
								   "name":"neg_negotiations_cases_name"}}, 
			"single", 
			true
		);
		
    }
}
function onChangeupdateRelatedCaseAssignedTo(){
	console.log('formName: '+ formName);
	var record_id= '';
	if(formName == 'EditView'){
		record_id= document.getElementsByName("record")[0].value;
	}else{
		record_id= 	$('#'+ formName +' #record').val();
	}
	console.log('record_id: '+ record_id);
	if(record_id === '' || record_id === undefined){
		console.log('asdasd');
		updateRelatedCaseAssignedTo();
	}
}
function showhideNegFields(){
	var  record_id = $("#neg_negotiations_casescases_ida").val();
	if(record_id != ''){
		$.ajax({
		   type: "POST",
		   url: 'index.php?module=Cases&action=get_related_case_type&record='+record_id,
		   async:true,
		   data: 'sugar_body_only=1',
		   success: function(response){
				 casetype = response;
				if(casetype.indexOf("Companion") != -1)
				{
				  $('div[field="companion"]').parent().show();
				}
				else {
				 $('div[field="companion"]').parent().hide();
				}
			}
		});
	}else{
		$('div[field="companion"]').parent().hide();
	}
	/* if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	}	 */

}

function updateRelatedCaseAssignedToClear(){
	$('#user_id_c').val('');
	$('#case_assigned_to_c').val('');
	$('div[field="companion"]').parent().hide();
}
function updateRelatedCaseAssignedTo(collection){
	var related_id = $("#neg_negotiations_casescases_ida").val();
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=NEG_Negotiations&action=getRelatedCaseAssignedTo&related_id='+related_id,
			async: false,
			success: function(response){
				var obj = JSON.parse(response);
				$('#'+ formName +" #multiple_assigned_users  option:selected").removeAttr("selected");
				$('#'+ formName +" #multiple_assigned_users").multiselect( 'reset' );
				$('#'+ formName +" #multiple_assigned_users option[value='"+ obj.assigned_user_id +"']").attr('selected', 'selected');
				$('#'+ formName +" #multiple_assigned_users").multiselect( 'reset' );
				$('#'+ formName +' #user_id_c').val(obj.assigned_user_id);
				$('#'+ formName +' #case_assigned_to_c').val(obj.assigned_user_name);
			}
		});
	}
	/* if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	} */
}

function OpenPopupDefandant(){
	var case_id= $('#neg_negotiations_casescases_ida').val();
	var parent_id = "";
	if(case_id != ''){
		parent_id = "&query=1&parent_id=" + case_id;
	}
	open_popup(
		document[formName].parent_type.value,
		 600,
		 400,
		 parent_id,
		 true,
		 false, 
		{
		"call_back_function":"set_return",
		"form_name":formName,
		"field_to_name_array":{
		"id":"parent_id",
		"name":"parent_name"}},
		 "single",
		true
	 );
}