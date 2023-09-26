$(document).ready(function() {
	initComplaintConType();
});

function initComplaintConType(){
    showhideJudgeFields();
    changeConType(); //Call onchange function
}
function showhideJudgeFields(){
	cont_type = document.getElementById('contact_type_c').value;
    if(cont_type == "Judge") {
		$('div[data-label="LBL_JUDGE_ASSISTANT"]').show();
		$('div[field="judge_assistant_c"]').show();
		$('div[data-label="LBL_JUDGE_ASST_PHONE"]').show();
		$('div[field="judge_asst_phone_c"]').show();
		$('div[data-label="LBL_JUDGE_ASST_EMAIL"]').show();
		$('div[field="judge_asst_email_c"]').show();
		$('div[data-label="LBL_JUDGE_WEB_PAGE"]').show();
		$('div[field="judge_web_page_c"]').show();
	}else{
		$('div[data-label="LBL_JUDGE_ASSISTANT"]').hide();
		$('div[field="judge_assistant_c"]').hide();
		$('div[data-label="LBL_JUDGE_ASST_PHONE"]').hide();
		$('div[field="judge_asst_phone_c"]').hide();
		$('div[data-label="LBL_JUDGE_ASST_EMAIL"]').hide();
		$('div[field="judge_asst_email_c"]').hide();
		$('div[data-label="LBL_JUDGE_WEB_PAGE"]').hide();
		$('div[field="judge_web_page_c"]').hide();
	}
}

function changeConType(){
	document.getElementById("contact_type_c").onchange = function() {
        showhideJudgeFields(); //Call hide/show function
    }
}
