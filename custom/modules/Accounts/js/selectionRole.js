function selectionContactRole(module, id){
	 SUGAR.util.globalEval("var temp_request_data = " + window.document.forms['popup_query_form'].request_data.value);
    if (temp_request_data.jsonObject) {
        var request_data = temp_request_data.jsonObject;
    } else {
        var request_data = temp_request_data;
    }
    var passthru_data = Object();
    if (typeof(request_data.passthru_data) != 'undefined') {
        passthru_data = request_data.passthru_data;
    }
	if(passthru_data.parent_module == 'Cases'){
		$.ajax({
			type: "POST",
			async:false,
			url: "index.php?module="+module+"&action=RoleSelection&record="+id,
			success : function (result){
				document.getElementById("message_dialog_role").innerHTML =result;
				var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog_role', {
					width: "650px",
					effect:{
						effect: YAHOO.widget.ContainerEffect.FADE,
						duration: 0.25
					},
					fixedcenter: true,
					modal: true,
					visible: false,
					close : true,
					draggable : true,
					zIndex:15000
				});
				quickEditDialog.render(document.body);	
				quickEditDialog.setHeader("Select Role")
				$(".container-close").click(function(){
					quickEditDialog.hide();	
				});
				quickEditDialog.show();
			},
			error : function (error){
				alert(error);
			}
		});
	}else{
		send_back(module, id);
	}

}


function send_back_role_selection(id, module) {
	if($('#account_role').val() == ' '){
		return true;
	}
	var account_role = $('#account_role').val();
    var associated_row_data = associated_javascript_data[id];
    SUGAR.util.globalEval("var temp_request_data = " + window.document.forms['popup_query_form'].request_data.value);
    if (temp_request_data.jsonObject) {
        var request_data = temp_request_data.jsonObject;
    } else {
        var request_data = temp_request_data;
    }
    var passthru_data = Object();
    if (typeof(request_data.passthru_data) != 'undefined') {
        passthru_data = request_data.passthru_data;
    }
    var form_name = request_data.form_name;
    var field_to_name_array = request_data.field_to_name_array;
    SUGAR.util.globalEval("var call_back_function = window.opener." + request_data.call_back_function);
    var array_contents = Array();
	array_contents.push('"REL_ATTRIBUTE_account_role":"' + account_role + '"');
    var fill_array_contents = function(the_key, the_name) {
        var the_value = '';
        if (module != '' && id != '') {
            if (associated_row_data['DOCUMENT_NAME'] && the_key.toUpperCase() == "NAME") {
                the_value = associated_row_data['DOCUMENT_NAME'];
            } else if ((the_key.toUpperCase() == 'USER_NAME' || the_key.toUpperCase() == 'LAST_NAME' || the_key.toUpperCase() == 'FIRST_NAME') && typeof(is_show_fullname) != 'undefined' && is_show_fullname && form_name != 'search_form') {
                the_value = associated_row_data['FULL_NAME'];
            } else {
                the_value = associated_row_data[the_key.toUpperCase()];
            }
        }
        if (typeof(the_value) == 'string') {
            the_value = the_value.replace(/\r\n|\n|\r/g, '\\n');
        }
        array_contents.push('"' + the_name + '":"' + the_value + '"');
    }
    for (var the_key in field_to_name_array) {
        if (the_key != 'toJSON') {
            if (YAHOO.lang.isArray(field_to_name_array[the_key])) {
                for (var i = 0; i < field_to_name_array[the_key].length; i++) {
                    fill_array_contents(the_key, field_to_name_array[the_key][i]);
                }
            } else {
                fill_array_contents(the_key, field_to_name_array[the_key]);
            }
        }
    }
    var popupConfirm = confirmDialog(array_contents, form_name);
    SUGAR.util.globalEval("var name_to_value_array = {" + array_contents.join(",") + "}"); closePopup();
    var result_data = {
        "form_name": form_name,
        "name_to_value_array": name_to_value_array,
        "passthru_data": passthru_data,
        "popupConfirm": popupConfirm
    };
    call_back_function(result_data);
}

