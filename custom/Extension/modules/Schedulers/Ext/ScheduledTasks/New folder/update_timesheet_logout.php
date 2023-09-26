<?php 
$job_strings[] = 'update_timesheet_logout';

function update_timesheet_logout(){
	global $db,$log;
	
	$sql = "UPDATE ht_timesheet ts
		INNER JOIN 
		(
			SELECT * FROM 
			(SELECT DATE(date_entered) AS tsdate, created_by, date_entered, action_name
						FROM usersactivity
						WHERE deleted = 0
			ORDER BY date_entered DESC
			) ua_desc
						GROUP BY DATE(ua_desc.date_entered), ua_desc.created_by,ua_desc.tsdate, date_entered, action_name
		) ua
		ON ts.assigned_user_id = ua.created_by AND tsdate = ts.work_date
		SET ts.logout = ua.date_entered
		WHERE ts.deleted = 0";
	$result = $db->query($sql, true);
	return true;
}
