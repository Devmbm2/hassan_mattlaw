$(document).ready(function() {
	initContPastWork();
});

function initContPastWork(){
    showhideWorkInjury();
    changePastWork(); //Call onchange function
}
function showhideWorkInjury(){
	pastwork = $('input[name=work_injury_c]:checked').val();
	if(pastwork == "Yes")
	{
		$('#work_injury_status_c').parent().parent().parent().show();
		 showhideDescWork();
		
	}
	else {
		$('#work_injury_status_c').parent().parent().parent().hide();
		 $('#work_injury_details_c').parent().parent().hide();
	}
}

function changePastWork(){
     $("input[name=work_injury_c]").click(function() {
        showhideWorkInjury(); //Call hide/show function
    });
}