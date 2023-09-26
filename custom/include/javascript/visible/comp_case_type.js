$(document).ready(function() {
function initCompCaseType(){
    showhideCompFields();
    changeCompFields(); //Call onchange function
}
function showhideCompFields(){
        compcasetype = $('#type').val();
        //console.log(casetype);
		if(compcasetype != undefined){
			if(compcasetype.includes("Companion"))
			{
			   $('div[data-label="LBL_COMPANION"]').show();
			   $('div[field="companion"]').show();
			}
			else {
			   $('div[data-label="LBL_COMPANION"]').hide();
			   $('div[field="companion"]').hide();
			}
		}
        
}

function changeCompFields(){
     $('#btn_comp_companions_cases_name').focus(function() {
            // console.log(casetype);
        showhideCompFields(); //Call hide/show function
    });
}
   initCompCaseType();
});

