$(document).ready(function() {
function initCompComplaintType(){
    showhideCompFields();
    changeCompFields(); //Call onchange function
}
function showhideCompFields(){
        compcomplainttype = $('#type').val();
        //console.log(complainttype);
        if(compcomplainttype.includes("Companion"))
        {
           $('div[data-label="LBL_COMPANION"]').show();
           $('div[field="companion"]').show();
        }
        else {
           $('div[data-label="LBL_COMPANION"]').hide();
           $('div[field="companion"]').hide();
        }
}

function changeCompFields(){
     $('#btn_comp_companions_complaints_name').focus(function() {
            // console.log(complainttype);
        showhideCompFields(); //Call hide/show function
    });
}
   initCompComplaintType();
});

