var fields = ['phone_work', 'phone_other', 'phone_mobile','caller_office_phone_c','caller_number_c','phone_fax'];
$.each(fields, function(index, value){
	if($('#'+value).length > 0){
		$('#'+value).attr('placeholder', '999-999-9999 X 999999');
		$('#'+value).mask('999-999-9999 X 999999');
	}
});