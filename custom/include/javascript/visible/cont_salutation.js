/*$(document).ready(function() {
	showhideJudgeWeb();
	$( "#salutation" ).change(function() {
	  showhideJudgeWeb();
	});
});

function showhideJudgeWeb(){
	//	console.log('testht1234');
        var salutation = $('#salutation').val();
        if(salutation == "Honorable")
        {
           $('div[data-label="LBL_JUDGE_WEB_PAGE"]').show();
           $('div[field="judge_web_page_c"]').show();
	   $('#assistant').parent().parent().show();
           $('#assistant_phone').parent().parent().show();
        }
        else {
           $('div[data-label="LBL_JUDGE_WEB_PAGE"]').hide();
           $('div[field="judge_web_page_c"]').hide();
        }
		if(salutation == "Dr." || salutation == "Prof." || salutation == "Honorable") {
				console.log('testht1');
			   $('#assistant').parent().parent().show();
			   $('#assistant_phone').parent().parent().show();
		}
		else {
				$('#assistant').parent().parent().hide();
				$('#assistant_phone').parent().parent().hide();
		}
}
*/
