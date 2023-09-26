$(document).ready(function(){
	$('#pleading_sub_type_description').keypress(function(e) {
		var tval = $('#pleading_sub_type_description').val(),
			tlength = tval.length,
			set = 100,
			remain = parseInt(set - tlength);
		$('p').text(remain);
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			$('#pleading_sub_type_description').val((tval).substring(0, tlength - 1));
			return false;
		}
	});
	subcategory_event_notice($("#subcategory_id").val());
	$("#subcategory_id").change(function () {
		subcategory_event_notice(this.value)
    });

});

function subcategory_event_notice(value){
	if(value == 'Hearing_Notice'){
		required_fields['date_start_date'] = 'Start Date';
		required_fields['date_end_date'] = 'End Date';
		required_fields['duration'] = 'Duration';
		required_fields['type_c'] = 'Purpose';
		required_fields['event_type'] = 'Type';
		required_fields['events_multiple_assigned_users'] = 'Multiple Assigned To';
	}else{
		if(typeof required_fields !== "undefined"){
			delete required_fields.date_start_date;
			delete required_fields.date_end_date;
			delete required_fields.duration;
			delete required_fields.type_c;
			delete required_fields.event_type;
			delete required_fields.events_multiple_assigned_users;
		}
	}
}