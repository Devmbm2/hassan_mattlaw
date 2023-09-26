$(document).ready(function(){
	addValidate();
	$('#btn_human_defendant').focus(function(){removeValidate();});
	$('#btn_clr_human_defendant').focus(function(){addValidate();});
	$('#btn_defendant_organization').focus(function(){removeValidate();});
	$('#btn_clr_defendant_organization').focus(function(){addValidate();});
});

function addValidate(){
	addToValidate('EditView','human_defendant');
	$('div[data-label="LBL_HUMAN_DEFENDANT"]').html('Human Defendant: <span class="required">*</span>');
	addToValidate('EditView','defendant_organization');
    $('div[data-label="LBL_DEFENDANT_ORGANIZATION"]').html('Defendant Organization: <span class="required">*</span>');
}

function removeValidate(){
	if($('#human_defendant').val() != ''){
	 removeFromValidate('EditView','defendant_organization');
		$('div[data-label="LBL_DEFENDANT_ORGANIZATION"]').html('Defendant Organization :');
	}
	if($('#defendant_organization').val() != ''){
	 removeFromValidate('EditView','human_defendant');
		$('div[data-label="LBL_HUMAN_DEFENDANT"]').html('Human Defendant :');
	}

}
