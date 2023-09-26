$(document).ready(function() {
	initNegType();
});

function initNegType(){
    showhideExpDate();
    changeNegType(); //Call onchange function
}
function showhideExpDate(){
        neotype = document.getElementById('type').value;
        if(neotype == "Mediation_Offer")
        {
           $('div[data-label="LBL_DOC_EXP_DATE"]').show();
           $('div[field="exp_date"]').show();
        }
        else {
           $('div[data-label="LBL_DOC_EXP_DATE"]').hide();
           $('div[field="exp_date"]').hide();
        }
}

function changeNegType(){
     document.getElementById("type").onchange = function() {
        showhideExpDate(); //Call hide/show function
    }
}
