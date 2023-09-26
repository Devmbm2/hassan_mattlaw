function initType(){
        value = document.getElementsByName('type_c')[0].value;
        //deponent_c visible
        if(value =="Deposition")
        {
            $('div[data-label="LBL_DEPONENT"]').show();
            $('div[field="deponent_c"]').show();
        } else {
            $('div[data-label="LBL_DEPONENT"]').hide();
            $('div[field="deponent_c"]').hide();
        }
        //videographer_c visible
        if(value =="Deposition" || value =="Compulsory_Medical_Exam")
        {
            $('div[data-label="LBL_VIDEOGRAPHER"]').show();
            $('div[field="videographer_c"]').show();
        } else {
            $('div[data-label="LBL_VIDEOGRAPHER"]').hide();
            $('div[field="videographer_c"]').hide();
        }
        //court_reporter_c visible
        if(value =="Deposition" || value =="Trial" || value =="Hearing" || value =="Statement_Under_Oath")
        {
                $('div[data-label="LBL_COURT_REPORTER"]').show();
                $('div[field="court_reporter_c"]').show();
        }
        else {
                $('div[data-label="LBL_COURT_REPORTER"]').hide();
                $('div[field="court_reporter_c"]').hide();
        }
    changeType(); //Call onchange function
}

function changeType(){
     document.getElementById("type_c").onchange = function() {
        initType(); //Call hide/show function
    }
}
if (window.addEventListener)
window.addEventListener("load", initType, false)
else if (window.attachEvent)
window.attachEvent("onload", initType)
