$(document).ready(function(){
	if(bean['case_type_c'].includes('Companion') == false){
		$("[field='companion']").parent().html('');
	}
	if(bean['case_type_c']!='Multiple_Claims_in_One'){
		$("[field='date_of_incident']").parent().html('');
	}
});
