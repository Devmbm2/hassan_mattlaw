$(document).ready(function(){
	$("#btn_default_assistant_name").attr("onclick", "OpenPopupDefaultAssistant();");
});
function OpenPopupDefaultAssistant(){
	var record_id= document.getElementsByName("record")[0].value;
    if (record_id) {
     open_popup(
		"Users", 
		600, 
		400, 
		"&query=1&parent_id=" +
				record_id,
		true, 
		false, 
		{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"default_assistant_id","name":"default_assistant_name"}}, 
		"single", 
		true
		);
    }
}
