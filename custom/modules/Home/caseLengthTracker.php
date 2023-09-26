<?php
caseLengthTracker();
function caseLengthTracker()
{
	set_time_limit(9000);
	ini_set('memory_limit', '2048M'); //blacklist while package scan
	global $db, $app_list_strings;
	$field_mapping = $app_list_strings['case_status_track_mapping'];
	$all_fields_sum = '';
	foreach($field_mapping AS $status => $field_id){
		$query = "UPDATE cases c
		INNER JOIN cases_cstm cs ON (cs.id_c = c.id)
		SET  {$field_id} = IF({$field_id} < 1 OR {$field_id} IS NULL, 1, {$field_id} - 1)
		WHERE c.deleted = 0 AND  c.`status` = '{$status}' ";
		// $db->query($query);
		$all_fields_sum .= " IF( {$field_id} = '' OR {$field_id} IS NULL, 0, {$field_id}) +";
	}
	$all_fields_sum = trim($all_fields_sum,"+");
	$query = "UPDATE cases c
		INNER JOIN cases_cstm cs ON (cs.id_c = c.id)
		SET   total_case_length_c = {$all_fields_sum}
		WHERE c.deleted = 0 AND  c.`status` != 'Closed' ";
		// $db->query($query);
	return true;
}
