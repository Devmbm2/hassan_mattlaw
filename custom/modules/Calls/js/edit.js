$(document).ready(function(){
	SUGAR.util.doWhen(
		"typeof(formName) != 'undefined'",
		onChange
);				
	$("select[name='select_related_caller_record_c']").parent().parent().hide();
	hideCallType();

});

function onChange(){
	$('#'+formName+' #contact_id_c').attr('onchange','updateRelatedFields();');	
	$('#'+formName+' #call_contact_c').attr('onchange','updateRelatedFields();');
	$('#'+formName+' #call_contact_c').attr('onblur','updateRelatedFields();');
	$("select[name='call_type_c']").attr('onchange','relatedRecords();');
	$("select[name='select_related_caller_record_c']").attr('onchange','populateCallerContact();updateRelatedFields();');
}


	function updateRelatedFields(collection){
			var parent_case_id = document.getElementsByName("record")[0].value;
			var related_id = '';
			if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
				related_id = collection['name_to_value_array']['contact_id_c'];
			}
			else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
				related_id = collection['id'];
			}else if($('#'+formName+' #contact_id_c').val() != ''){
				console.log(formName);
				related_id = $('#'+formName+' #contact_id_c').val();
			}
			console.log('related_id 123');
			console.log(related_id);
			if(related_id != ''){
				$.ajax({
					type: 'POST',
					url: 'index.php?module=Calls&action=getRelatedContactData&related_id='+related_id,
					async: false,
					success: function(response){
					console.log(response);
					var obj = JSON.parse(response);
						console.log('run');
						console.log(obj);
						$('#'+formName+' #caller_number_c').val(obj.phone_mobile);     
						$('#'+formName+' #caller_number_c').mask('999-999-9999 X 999999');     
						$('#'+formName+' #caller_office_phone_c').val(obj.phone_work);
						$('#'+formName+' #caller_office_phone_c').mask('999-999-9999 X 999999');
					}
				});
				$.ajax({
					type: 'POST',
					url: 'index.php?module=Calls&action=checkContactExistsUnderCase&parent_case_id='+ parent_case_id +'&related_id='+related_id,
					async: false,
					success: function(response){
						console.log('response');
						console.log(response);
						if(response){
							$('#contact_role').parent().parent().show();
							if(typeof required_fields !== "undefined"){
								required_fields['contact_role'] = 'Contact Role';
							}
						}else{
							if(typeof required_fields !== "undefined"){
								delete required_fields['contact_role'];
							}
							$('#contact_role').parent().parent().hide();
						}
					}
				});
			}

		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			set_return(collection);
		}
	}


function relatedRecords(){
$("select[name='select_related_caller_record_c']").parent().parent().show();
var caller_type = $("select[name='call_type_c']").val();
var relate_module = $("input[name='relate_to']").val();
if(relate_module == 'Cases'){
var case_id = $("input[name='relate_id']").val();
}
else{
	var case_id = '';
}
if(caller_type){
	$.ajax({
		type: 'POST',
		url: 'index.php?module=Calls&action=getRelatedCallRecord&caller_type='+ caller_type + '&case_id=' + case_id,
		async: false,
		success: function(response){
			var obj = JSON.parse(response);
			if(obj){
				$("select[name='select_related_caller_record_c']").empty();
				$.each(obj, function(k, v) {
				$("select[name='select_related_caller_record_c']").append(`<option value = ${k}>${v}</option>`);
			})
			}else{
				$("select[name='select_related_caller_record_c']").empty();
			}
		}
	});
}
else
{
	$("select[name='select_related_caller_record_c']").parent().parent().hide();
}
}
	
function populateCallerContact(){
var related_record_id = $("select[name='select_related_caller_record_c'] option:selected").val();
var related_record_name = $("select[name='select_related_caller_record_c'] option:selected").text();
if(related_record_id){
	$("input[name = 'call_contact_c']").val(related_record_name);
	$("input[name = 'contact_id_c']").val(related_record_id);
}
}
function hideCallType(){
 var parent_module = $("input[name='parent_type']").val();
 if(parent_module == 'Accounts' || parent_module == 'Contacts'){
 	$("select[name='call_type_c']").parent().parent().hide();
 }
 else{
 	$("select[name='call_type_c']").parent().parent().show();
 }
}

