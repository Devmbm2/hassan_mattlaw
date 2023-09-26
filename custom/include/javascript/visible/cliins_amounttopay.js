function initMedPay(){
        value = $('#med_pay_result').val();
        if(value =="Settled")
        {
                $('div[data-label="LBL_AMOUNT_TO_PAY"]').parent().show();
                $('div[field="amount_to_pay"]').parent().show();
        }
        else {
                $('div[data-label="LBL_AMOUNT_TO_PAY"]').parent().hide();
                $('div[field="amount_to_pay"]').parent().hide();
        }
    changeMedPay(); //Call onchange function
}

function changeMedPay(){
    /*  document.getElementById("med_pay_result").onchange = function() {
        initMedPay(); 
    } */
}
$(document).ready(function() {
        initMedPay();
})
