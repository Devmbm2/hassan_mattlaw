$(document).ready(function() {
	initDocType();
	$('#transcript_types_c').attr('onchange','showhideBaseType();');
});

function initDocType(){
	showhideBaseType();
	changeBaseType(); //Call onchange function
}

function changeBaseType(){
     document.getElementById("subcategory_id").onchange = function() {
        showhideBaseType(); //Call hide/show function
    }
}

function showhideBaseType(){
	doctype = document.getElementById('subcategory_id').value;
	$('#case_type_c').parent().parent().hide();
	$('#case_status_c').parent().parent().hide();
	$('#contacts_documents_1_name').parent().parent().hide();
	$('#format_c').parent().parent().hide();
	$('#trial_type').parent().parent().hide();
	//Show/Hide Orders Sub Type
	if(doctype == "Transcripts_Statements") {
		$('#transcript_types_c').parent().parent().show();
		//$('#document_name').parent().parent().hide();
		$('#contacts_documents_1_name').parent().parent().show();
		$('#format_c').parent().parent().show();
		$('#transcript_types_c').attr('onchange','addValidate()');
		//addToValidate('EditView','contacts_documents_1_name','relate',true,'{$mod_strings["LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE"]}');
		//$('div[data-label="LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE"]').html('Deponent:<font color="#edd03d">*</font>');

	}else{
		$('#transcript_types_c').parent().parent().hide();
		//$('#document_name').parent().parent().show();
	}
	//Show/Hide Notice Type
	if(doctype == "Client_Insurance")  {
		$('#insurance_type_c').parent().parent().show();
	}
	else {
		$('#insurance_type_c').parent().parent().hide();
	}
	//Show/hide Name of Motion
	if(doctype == "Authorizations")  {
		$('#authorization_types_c').parent().parent().show();
	}
	else {
		$('#authorization_types_c').parent().parent().hide();
	}
	//Show/Hide Hearing Type
	if(doctype == "Defendant_Insurance")  {
		$('#def_insurance_types_c').parent().parent().show();
	}
	else {
		$('#def_insurance_types_c').parent().parent().hide();
	}
	if(doctype == "Investigation")  {
		$('#investigation_types_c').parent().parent().show();
	}
	else {
		$('#investigation_types_c').parent().parent().hide();
	}
	if(doctype == "Trial")  {
		$('#trial_type').parent().parent().show();
	}
}
function addValidate() {
	var trans_type = $('#transcript_types_c').val();
        removeFromValidate('EditView','contacts_documents_1_name');
	$('div[data-label="LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE"]').html('Deponent:');
        if (trans_type == "Depositions" || trans_type == "Witness_Statements"){
               addToValidate('EditView','contacts_documents_1_name','relate',true,'{$mod_strings["LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE"]}');
               $('div[data-label="LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE"]').html('Deponent:<font color="#edd03d">*</font>');
        }

}
