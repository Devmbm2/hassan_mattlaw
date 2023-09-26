$(document).ready(function(){
	create_event();
	if($("#create_event").is(":checked")){
		required_fields['date_start_date'] = 'Start Date';
		required_fields['date_end_date'] = 'End Date';
		$('#detailpanel_1').parent().show();
	}else{
		if(typeof required_fields !== "undefined"){
			delete required_fields.date_start_date;
			delete required_fields.date_end_date;
		}
		$('#detailpanel_1').parent().hide();
	}
	
});

function create_event(){
	$("#create_event").change(function() {
		if(this.checked) {
			required_fields['date_start_date'] = 'Start Date';
			required_fields['date_end_date'] = 'End Date';
			$('#detailpanel_1').parent().show();
		}else{
			if(typeof required_fields !== "undefined"){
				delete required_fields.date_start_date;
				delete required_fields.date_end_date;
			}
			$('#detailpanel_1').parent().hide();
		}
	});
}