$(document).ready(function(){
	SUGAR.util.doWhen(
			"typeof(display_hide_fields) != 'undefined'",
			show_hide_fields_ready
	);
});
function show_hide_fields_ready(){
	show_hide_fields();
	subcategory_id_show_hide_fields();
	showhideBaseNotTyp();
	/* $('#category_id').attr('onchange','show_hide_fields();'); */
	
}
function show_hide_fields(){
	/* var fields_to_hide = ['subcategory_id', 'complaint_answer_type', 'name_of_motion', 'notice_type', 'filing_sub_type', 'hearing_type', 'sent_received', 'orders_sub_type']; */
	var fields_to_hide = ['subcategory_id', 'complaint_answer_type', 'name_of_motion', 'notice_type'/* , 'filing_sub_type' */, 'hearing_type', /* 'sent_received','amount',  */'orders_sub_type'];
	$.each(fields_to_hide, function( index, value ){
		$('#'+value).closest('.detail-view-row').hide();
	});
	if($('#category_id').val() == 'Pleading'){
		$('#subcategory_id').closest('.detail-view-row').show();
		subcategory_id_show_hide_fields();
		/* $('#subcategory_id').attr('onchange','subcategory_id_show_hide_fields();'); */
	}
}
function subcategory_id_show_hide_fields(){
	var subcategory_id = $('#subcategory_id').val();
	if(subcategory_id == 'Notice'){
		$('#amount').parent().parent().show();
		$('#sent_received').parent().parent().show();
	}else{
		$('#amount').parent().parent().hide();
		$('#sent_received').parent().parent().hide();
	}
	if(typeof(display_hide_fields) != 'undefined' && display_hide_fields != ''){
		
		$.each(display_hide_fields, function( index, value ){
					if(index != subcategory_id){
						$.each(value, function( value1, field ){
							$('#'+field).closest('.detail-view-row').hide();
						});				
					}
				});
	}
	
	if(typeof(subcategory_id) != 'undefined' && subcategory_id != ''){
		var selected_subcategory_id_value = display_hide_fields[subcategory_id];
		if(typeof(selected_subcategory_id_value) != 'undefined' && selected_subcategory_id_value != ''){
			$.each(selected_subcategory_id_value, function( index, value ){
				$('#'+value).closest('.detail-view-row').show();
			});
		}
		
	}
	
	
		
}
