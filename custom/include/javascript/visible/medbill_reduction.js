$(document).ready(function() {
function initReduction(){
    showhideRedApr();
    changeReduction(); //Call onchange function
}
function showhideRedApr(){
        $('#reduction_approved_by').parent().parent().hide();
	//Show fields
        red_amnt = $('#reduction_amount').val();
        if(red_amnt > 0)  {
           $('#reduction_approved_by').parent().parent().show();
        }
}

function changeReduction(){
     document.getElementById("reduction_amount").onchange = function() {
        showhideRedApr(); //Call hide/show function
    }
}

initReduction();
});
