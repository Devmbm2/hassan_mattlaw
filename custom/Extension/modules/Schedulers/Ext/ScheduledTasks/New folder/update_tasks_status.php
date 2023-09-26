<?php
$job_strings[] = 'update_tasks_status';
function update_tasks_status()
{
	set_time_limit(9000);
	ini_set('memory_limit', '2048M'); //blacklist while package scan
	global $db, $app_list_strings;
	$sql = "UPDATE tasks SET `status` = 'overdue', date_modified = NOW() 
	WHERE deleted = 0 AND `status` = 'Due' AND date_due  < NOW()";
	$result = $db->query($sql);
	return true;
}
