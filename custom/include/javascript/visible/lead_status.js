$(document).ready(function() {
function initStatus(){
        /* $('div[data-label="LBL_REASON_FOR_LOST_LEAD"]').parent().hide(); */
        $('div[field="reason_for_lost_lead_c"]').parent().hide();
	//Show fields
        value = $('#status').val();
        if(value =="Dead")
        {
                /* $('div[data-label="LBL_REASON_FOR_LOST_LEAD"]').parent().show(); */
                $('div[field="reason_for_lost_lead_c"]').parent().show();
        }
    changeStatus(); //Call onchange function
}

function changeStatus(){
     document.getElementById("status").onchange = function() {
        initStatus(); //Call hide/show function
    }
}
initStatus();
});
