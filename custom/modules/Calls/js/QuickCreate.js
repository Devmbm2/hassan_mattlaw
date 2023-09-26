$(document).ready(function(){
	$('#contact_role').parent().parent().hide();
	if(typeof required_fields !== "undefined"){
		required_fields['contact_role'] = 'Contact Role';
	}
	onChangeQuick();
			

});

function onChangeQuick(){
	console.log('asdasd');
	 var parent_module = $("input[name='parent_type']").val();
 if(parent_module == 'Cases'){
 	$("#btn_call_contact_c").attr("onclick", "OpenPopupRelatedCaller();");
 }
 else {
 	// $("#btn_call_contact_c").attr("onclick", "OpenPopupRelatedCaller();");
 }
	
	$("#btn_clr_call_contact_c").click(function(){
	  clearRoleField();
	});
	
}
	
function clearRoleField(){
	$('#contact_role').parent().parent().hide();
	$('#caller_number_c').val('');
	$('#caller_office_phone_c').val('');
}
function OpenPopupRelatedCaller(){
	var parent_case_id = document.getElementsByName("record")[0].value;
	if (parent_case_id) {
		open_popup(
			"Contacts", 
			600, 
			400, 
			"&query=1&parent_case_id=" + parent_case_id + "&caller_type=" + $("#call_type_c").val(), 
			true, 
			false, 
			{"call_back_function":"updateRelatedFields","form_name":"form_SubpanelQuickCreate_Calls","field_to_name_array":{"id":"contact_id_c","mt_full_name":"call_contact_c","phone_mobile":"caller_number_c","phone_work":"caller_office_phone_c"}}, 
			"single", 
			true
		);
	}
}

