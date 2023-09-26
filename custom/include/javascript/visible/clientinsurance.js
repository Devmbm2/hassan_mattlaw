function initpolicyType(){
        value = $('#type').val();
        if(value =="PIP")
        {
                /* $('div[data-label="LBL_PIP_STATUS"]').show(); */
                $('div[field="pip_status"]').parent().show();
				/* $('div[data-label="LBL_AMOUNT_RECOVERED"]').hide(); */
                $('div[field="amount_recovered"]').parent().hide();
        }
        else {
                /* $('div[data-label="LBL_PIP_STATUS"]').hide(); */
                $('div[field="pip_status"]').parent().hide();
				/* $('div[data-label="LBL_AMOUNT_RECOVERED"]').show(); */
                $('div[field="amount_recovered"]').parent().show();
        }
	if(value =="Med_Pay")
        {
                /* $('div[data-label="LBL_MED_PAY_RESULT"]').show(); */
                $('div[field="med_pay_result"]').parent().show();
				/* $('div[data-label="LBL_AMOUNT_RECOVERED"]').hide(); */
                $('div[field="amount_recovered"]').parent().hide();
        }
        else {
                /* $('div[data-label="LBL_MED_PAY_RESULT"]').hide(); */
                $('div[field="med_pay_result"]').parent().hide();
				/* $('div[data-label="LBL_AMOUNT_RECOVERED"]').show(); */
                $('div[field="amount_recovered"]').parent().show();
        }
    changepolicyType(); //Call onchange function
}

function changepolicyType(){
     document.getElementById("type").onchange = function() {
        initpolicyType(); //Call hide/show function
    }
}
$(document).ready(function() {
        initpolicyType();
})
