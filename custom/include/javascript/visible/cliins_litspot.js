$(document).ready(function() {
function initClaimResult(){
	$('div[data-label="LBL_AMOUNT_RECOVERED"]').hide();
        $('div[field="amount_recovered"]').hide();
        
	value = document.getElementsByName('claim_result')[0].value;
        if(value =="PreSuit_Settlement" || value =="Lit_Settlement" || value =="Verdict")
        {
                $('div[data-label="LBL_AMOUNT_RECOVERED"]').show();
                $('div[field="amount_recovered"]').show();
        }
    changeClaimResult(); //Call onchange function
}

function changeClaimResult(){
     document.getElementById("claim_result").onchange = function() {
        initClaimResult(); //Call hide/show function
    }
}
initClaimResult();
})
