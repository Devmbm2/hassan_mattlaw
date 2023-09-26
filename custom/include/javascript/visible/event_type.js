function initeventType(){
	var value = $('#type_c').val();
	//deponent_c visible
	if(value =="Deposition")
	{
		/* $('div[data-label="LBL_DEPONENT"]').parent().show(); */
		$('div[field="deponent_c"]').parent().show();
	} else {
		/* $('div[data-label="LBL_DEPONENT"]').parent().hide(); */
		$('div[field="deponent_c"]').parent().hide();
	}
	//videographer_c visible
	if(value =="Deposition" || value =="Compulsory_Medical_Exam")
	{
		/* $('div[data-label="LBL_VIDEOGRAPHER"]').parent().show(); */
		$('div[field="videographer_c"]').parent().show();
	} else {
		/* $('div[data-label="LBL_VIDEOGRAPHER"]').parent().hide(); */
		$('div[field="videographer_c"]').parent().hide();
	}
	//court_reporter_c visible
	if(value =="Deposition" || value =="Trial" || value =="Hearing" || value =="Statement_Under_Oath")
	{
			/* $('div[data-label="LBL_COURT_REPORTER"]').parent().show(); */
			$('div[field="court_reporter_c"]').parent().show();
	}
	else {
			/* $('div[data-label="LBL_COURT_REPORTER"]').parent().hide(); */
			$('div[field="court_reporter_c"]').parent().hide();
	}
	//travel_date visible
	if(value =="Deposition" || value =="Trial" || value =="Hearing" || value =="Mediation" || value =="Intake" || value =="Meeting" || value =="Continuing_Legal_Education" || value =="Pre_Trial_Conference")
	{
			$('div[field="travel_start_c"]').parent().show();
			$('div[field="travel_end_c"]').parent().show();
	}
	else {
			$('div[field="travel_start_c"]').parent().hide();
			$('div[field="travel_end_c"]').parent().hide();
	}
	// if(value == "Virtual_Meeting_Online"){
	// 	$('#meeting_id').parent().parent().parent().parent().parent().parent().show();
	// }else{
	// 	$('#meeting_id').parent().parent().parent().parent().parent().parent().hide();
	// }
    changeType(); //Call onchange function
}

function initeventType2(){
	var purpose = $('#type_c').val();
	var event = $('#event_type').val();
	if(purpose == "Virtual_Meeting_Online" && event == "on_zoom"){
		$('#meeting_id').parent().parent().parent().parent().parent().parent().show();
	}else{
		$('#meeting_id').parent().parent().parent().parent().parent().parent().hide();
	}
	// alert(value);
	changeEventType();
	}

function changeType(){
     document.getElementById("type_c").onchange = function() {
        initeventType(); //Call hide/show function
    }
}
function changeEventType(){
     document.getElementById("event_type").onchange = function() {
        initeventType2(); //Call hide/show function
    }
}
$(document).ready(function() {
        initeventType();
        initeventType2();
})
