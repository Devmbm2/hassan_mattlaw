$(document).ready(function() {
function initPleadHeaTyp(){
    showhideBaseHeaTyp();
    changeBaseHeaTyp(); //Call onchange function
}
function showhideBaseHeaTyp(){
        heatyp = document.getElementById('hearing_type').value;
	//Show/Hide Sent Received
	if(heatyp == "Motion")  {
	   $('div[data-label="LBL_SENT_RECEIVED"]').show();
           $('div[field="sent_received"]').show();
        }
        else {
	   $('div[data-label="LBL_SENT_RECEIVED"]').hide();
           $('div[field="sent_received"]').hide();
        }
}

function changeBaseHeaTyp(){
     document.getElementById("hearing_type").onchange = function() {
        showhideBaseHeaTyp(); //Call hide/show function
    }
}

initPleadHeaTyp();
});
