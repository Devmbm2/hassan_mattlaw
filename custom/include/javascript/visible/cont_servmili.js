function initContServMili(){
    showhideHonoDisc();
    changeServMili(); //Call onchange function
}
function showhideHonoDisc(){
        servmili = $('input[name=military_c]:checked').val();
        if(servmili == "Yes")
        {
		    $('#honorably_discharged_c').parent().parent().show();
        }
        else {
		    $('#honorably_discharged_c').parent().parent().hide();
        }
}

function changeServMili(){
     $("input[name=military_c]").click(function() {
        showhideHonoDisc(); //Call hide/show function
    });
}
$(document).ready(function() {
        initContServMili();
})
