$(document).ready(function() {
function initContEverArre(){
    showhideArreDetail();
    changeEverArre(); //Call onchange function
}
function showhideArreDetail(){
        arrested = $('input[name=arrested_c]:checked').val();
        if(arrested == "Yes")
        {
		   $('#arrest_details_c').parent().parent().show();
        }
        else {
          $('#arrest_details_c').parent().parent().hide();
        }
}

function changeEverArre(){
     $("input[name=arrested_c]").click(function() {
        showhideArreDetail(); //Call hide/show function
    });
}
initContEverArre();
});

