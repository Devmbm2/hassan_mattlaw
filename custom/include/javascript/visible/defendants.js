$(document).ready(function() {
	initClaim();
});
function changeClaim(){
        document.getElementById("claim_result").onchange = function() {
            initClaim(); //Call hide/show function
        }
}
function initClaim(){
        value = $('#claim_result').val();
        //lit_spot visible
        if(value =="Filed_Suit")
        {
            /* $('div[data-label="LBL_LIT_SPOT"]').parent().show(); */
            $('div[field="lit_spot"]').parent().show();
        }
        else {
            /* $('div[data-label="LBL_LIT_SPOT"]').parent().hide(); */
            $('div[field="lit_spot"]').parent().hide();
        }
	if(value =="PreSuit_Settlement" || value =="Lit_Settlement" || value =="Verdict")
        {
            /* $('div[data-label="LBL_AMOUNT_RECOVERED"]').parent().show(); */
            $('div[field="amount_recovered_c"]').parent().show();
            $('#firm_fee').parent().parent().show();
        }
        else {
            /* $('div[data-label="LBL_AMOUNT_RECOVERED"]').parent().hide(); */
            $('div[field="amount_recovered_c"]').parent().hide();
            $('#firm_fee').parent().parent().hide();
        }
        changeClaim(); //Call onchange function
}
