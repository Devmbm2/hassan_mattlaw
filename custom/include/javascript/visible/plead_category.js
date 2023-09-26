$(document).ready(function() {
function initPleadCatId(){
    showhideBaseCatId();
    changeBaseCatId(); //Call onchange function
}
function showhideBaseCatId(){
        catid = document.getElementById('category_id').value;
	//Show/Hide Sent Received
	if(catid == "Pleading")  {
	   $('div[data-label="LBL_SF_SUBCATEGORY"]').show();
           $('div[field="subcategory_id"]').show();
        }
        else {
	   $('div[data-label="LBL_SF_SUBCATEGORY"]').hide();
           $('div[field="subcategory_id"]').hide();
        }
}

function changeBaseCatId(){
     document.getElementById("category_id").onchange = function() {
        showhideBaseCatId(); //Call hide/show function
    }
}
   initPleadCatId();
});
