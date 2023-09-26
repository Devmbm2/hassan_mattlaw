$(document).ready(function() {  
	initCaseSource();
	changeCaseSource(); //Call onchange function
});
function initCaseSource(){
	value = document.getElementsByName('source_c')[0].value;
	if(value =="Referral_from_Attorney")
	{
		$('div[data-label="LBL_REFERRAL_ATTORNEY"]').show();
		$('div[field="referral_attorney_c"]').show();
		$('div[data-label="LBL_REFERRAL_FEE"]').show();
		$('div[field="referral_fee_c"]').show();
		if(typeof required_fields != "undefined"){
			required_fields['contact_id3_c'] = 'Referral Attorney';
			//required_fields['referral_fee_c'] = 'Referral Fee';
		}
		
	}
	else {
		$('div[data-label="LBL_REFERRAL_ATTORNEY"]').hide();
		$('div[field="referral_attorney_c"]').hide();
		$('div[data-label="LBL_REFERRAL_FEE"]').hide();
		$('div[field="referral_fee_c"]').hide();
		if(typeof required_fields !== "undefined"){
			delete required_fields['contact_id3_c'];
			//delete required_fields['referral_fee_c'];
		}
	}
	if(value =="Referral_from_NonAttorney" || value =="Former_Client" )
	{
		$('div[data-label="LBL_REFERRAL_PERSON"]').show();
		$('div[field="referral_person_c"]').show();
		if(typeof required_fields !== "undefined"){
			required_fields['contact_id4_c'] = 'Referral Person';
		}
		
	}
	else {
		$('div[data-label="LBL_REFERRAL_PERSON"]').hide();
		$('div[field="referral_person_c"]').hide();
		if(typeof required_fields !== "undefined"){
			delete required_fields['contact_id4_c'];
		}
	}
}
function changeCaseSource(){
     document.getElementById("source_c").onchange = function() {
        initCaseSource(); //Call hide/show function
    }
}
