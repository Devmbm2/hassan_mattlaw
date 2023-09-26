$(document).ready(function() {
function initDocTran(){
    showhideTranType();
    changeTranType(); //Call onchange function
}
function showhideTranType(){
        trantype = document.getElementById('transcript_types_c').value;
	//Show/Hide Sent Received
	if(trantype == "Trial_Transcript")  {
	   $('div[data-label="LBL_TRIAL_TRANSCRIPT_TYPES"]').show();
           $('div[field="trial_transcript_types_c"]').show();
        }
        else {
	   $('div[data-label="LBL_TRIAL_TRANSCRIPT_TYPES"]').hide();
           $('div[field="trial_transcript_types_c"]').hide();
        }
}

function changeTranType(){
     document.getElementById("transcript_types_c").onchange = function() {
        showhideTranType(); //Call hide/show function
    }
}

initDocTran();
});
