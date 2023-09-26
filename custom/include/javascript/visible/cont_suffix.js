$(document).ready(function() {

   initSalutation();
});

function initSalutation(){
    showhideJudgeWeb();
    $( "#salutation" ).change(function() {
	  showhideJudgeWeb();
	});
    $("#suffix").change(function() {
        showhideJudgeWeb(); //Call hide/show function
	});
}
function showhideJudgeWeb(){
        var salutation = $('#salutation').val();
        var suffix = $('#suffix').val();
        if(salutation == "Honorable")
        {
           $('div[data-label="LBL_JUDGE_WEB_PAGE"]').show();
           $('div[field="judge_web_page_c"]').show();
        }
        else {
           $('div[data-label="LBL_JUDGE_WEB_PAGE"]').hide();
           $('div[field="judge_web_page_c"]').hide();
        }
	if(salutation == "Dr." || salutation == "Prof." || salutation == "Honorable" || suffix == "Esq." || suffix == "MD" || suffix == "DC" || suffix == "DO" || suffix == "PhD") {
		    $('div[data-label="LBL_ASSISTANT"]').show();
           $('div[field="assistant"]').show();
           $('div[data-label="LBL_ASSISTANT_PHONE"]').show();
           $('div[field="assistant_phone"]').show();
	}
	else {
		$('div[data-label="LBL_ASSISTANT"]').hide();
		$('div[field="assistant"]').hide();
		$('div[data-label="LBL_ASSISTANT_PHONE"]').hide();
		$('div[field="assistant_phone"]').hide();

	}

}
