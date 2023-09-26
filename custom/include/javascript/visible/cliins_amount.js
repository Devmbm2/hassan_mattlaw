$(document).ready(function() {
	initClaimResult();
});
function initClaimResult(){
	$('div[data-label="LBL_AMOUNT_RECOVERED"]').parent().hide();
        $('div[field="amount_recovered"]').parent().hide();
	$('#firm_fee').parent().parent().hide();
        
	value = $('#claim_result').val();
        if(value =="PreSuit_Settlement" || value =="Lit_Settlement" || value =="Verdict")
        {
                $('div[data-label="LBL_AMOUNT_RECOVERED"]').parent().show();
                $('div[field="amount_recovered"]').parent().show();
		$('#firm_fee').parent().parent().show();
        }
    changeClaimResult(); //Call onchange function
}

function changeClaimResult(){
      document.getElementById("claim_result").onchange = function() {
        initClaimResult(); //Call hide/show function
    } 
}
