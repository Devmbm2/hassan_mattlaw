<?php 
$job_strings[] = 'update_timesheet_ip_address';

function update_timesheet_ip_address(){
	global $db,$log;
	
	$sql = "UPDATE ht_timesheet ts
		INNER JOIN 
		(
			SELECT DATE_SUB(date_entered, INTERVAL 7 HOUR) AS tsdate, ip_address, created_by
			FROM usersactivity
			WHERE deleted = 0 AND ip_address != '' AND ip_address  IS NOT NULL 
			GROUP BY DATE_SUB(date_entered, INTERVAL 7 HOUR), ip_address, created_by
		) ua
		ON ts.assigned_user_id = ua.created_by AND tsdate = ts.work_date
		SET ts.ip_address = ua.ip_address
		WHERE ts.deleted = 0";
	$result = $db->query($sql, true);
	return true;
}
