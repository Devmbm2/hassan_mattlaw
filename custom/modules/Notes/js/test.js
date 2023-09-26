$(document).ready(function(){
	var relate_id = $("input[name='relate_id']").val();
	$("#btn_parent_name").attr('onclick','open_popup(document.form_SubpanelQuickCreate_Notes.parent_type.value, 600, 400, "&relate_id_advanced='+relate_id+'", true, false, {"call_back_function":"myAwesomefunction","form_name":"form_SubpanelQuickCreate_Notes","field_to_name_array":{"id":"parent_id","name":"parent_name"}}, "single", true);');
})