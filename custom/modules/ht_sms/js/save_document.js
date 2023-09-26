function save_document(){
	_form = document.getElementById('link_document');
	_form.action.value='save_link_document';
	_form.record.value = record;
	addValidation();
	if(check_form('link_document')){
		SUGAR.ajaxUI.submitForm(_form);
	}
	
	return false;
}
$(function(){
	console.log('asdasdasd');
	$("#create_image").hide();
	$("#create_link").hide();
	addValidation();
});

function addValidation(){
	addToValidate('EditView', 'parent_id', 'relate', 'true', 'Relate To');
	addToValidate('EditView', 'file_name', 'varchar', true, 'File Name is required');
}