$(document).ready(function() {

    initContProbWork();
});

function initContProbWork(){
    showhideDescWork();
    changeProbWork(); //Call onchange function
}
function showhideDescWork(){
        probwork = $('input[name=work_injury_status_c]:checked').val();
        if(probwork == "Yes")
        {
		   $('#work_injury_details_c').parent().parent().show();
        }
        else {
		   $('#work_injury_details_c').parent().parent().hide();
        }
}

function changeProbWork(){
     $("input[name=work_injury_status_c]").click(function() {
        showhideDescWork(); //Call hide/show function
    });
}
