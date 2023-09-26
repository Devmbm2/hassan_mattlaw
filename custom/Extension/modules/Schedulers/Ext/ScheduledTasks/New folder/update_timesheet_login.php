<?php 
$job_strings[] = 'update_timesheet_login';

function update_timesheet_login(){
	global $db,$log;
	
	$sql = "UPDATE ht_timesheet ts
		INNER JOIN 
		(
			SELECT DATE(DATE_SUB(date_entered, INTERVAL 7 HOUR))  AS tsdate, created_by, date_entered 
			FROM usersactivity
			WHERE deleted = 0
			GROUP BY DATE(DATE_SUB(date_entered, INTERVAL 7 HOUR)) , created_by,date_entered
			ORDER BY date_entered ASC
		) ua
		ON ts.assigned_user_id = ua.created_by AND tsdate = ts.work_date
		SET ts.login = ua.date_entered  
		WHERE ts.deleted = 0";
	$result = $db->query($sql, true);
	return true;
}
