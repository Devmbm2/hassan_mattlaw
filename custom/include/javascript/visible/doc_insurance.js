$(document).ready(function() {
function initDocIns(){
    showhideNumVeh();
    changeInsType(); //Call onchange function
}
function showhideNumVeh(){
        instype = document.getElementById('insurance_type_c').value;
	//Show/Hide Sent Received
	if(instype == "Uninsured_Motorist_Stacked")  {
	   $('div[data-label="LBL_NUMBER_OF_VEHICLES_STACKING"]').show();
           $('div[field="number_of_vehicles_stacking_c"]').show();
        }
        else {
	   $('div[data-label="LBL_NUMBER_OF_VEHICLES_STACKING"]').hide();
           $('div[field="number_of_vehicles_stacking_c"]').hide();
        }
}

function changeInsType(){
     document.getElementById("insurance_type_c").onchange = function() {
        showhideNumVeh(); //Call hide/show function
    }
}

initDocIns();
});
