$(document).ready(function() {
function initMarital(){
    showhideSpouse();
    changeMarital(); //Call onchange function
}
function showhideSpouse(){
        marital = document.getElementById('marital_status_c').value;
        if(marital == "Married" || marital == "Separated" || marital == "Life_Partner")
        {
		   $('#spouse_name_c').parent().parent().show();
        }
        else {
		    $('#spouse_name_c').parent().parent().hide();
        }
}

function changeMarital(){
     document.getElementById("marital_status_c").onchange = function() {
        showhideSpouse(); //Call hide/show function
    }
}
   initMarital();
});
