<?php 
$job_strings[] = 'update_timesheet_day';

function update_timesheet_day(){
	global $db,$log;
	
	$sql = "UPDATE ht_timesheet ts
		SET ts.day = DAYNAME(ts.work_date) ";
	$result = $db->query($sql, true);
	return true;
}
