$(document).ready(function(){
	if(bean['type_c']!='Deposition'){
		$("[field='deponent_c']").parent().html('');
	}
	if(bean['type_c']!='Deposition' && bean['type_c']!='Compulsory_Medical_Exam'){
		$("[field='videographer_c']").parent().html('');
	}
	if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Statement_Under_Oath'){
		$("[field='court_reporter_c']").parent().html('');
	}
	if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Mediation' && bean['type_c']!='Intake' && bean['type_c']!='Meeting'){
		$("[field='travel_start_c']").parent().html('');
		$("[field='travel_end_c']").parent().html('');
		$("[field='travel_duration_hours_c']").parent().html('');
	}
});
