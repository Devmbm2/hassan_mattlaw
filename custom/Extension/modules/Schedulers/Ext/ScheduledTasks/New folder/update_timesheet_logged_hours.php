<?php 
$job_strings[] = 'update_timesheet_logged_hours';

function update_timesheet_logged_hours(){
	global $db,$log;
	
	$sql = "UPDATE ht_timesheet ts
		INNER JOIN 
		(
			SELECT id, TIME_FORMAT(TIMEDIFF(DATE_FORMAT(logout, '%H:%i'),DATE_FORMAT(login, '%H:%i')),'%H.%i') as logged_hours
			FROM ht_timesheet
			WHERE deleted = 0 AND (DATE(login) > (NOW() - INTERVAL 7 DAY))
		) tl
		ON ts.id = tl.id 
		SET ts.logged_hours = tl.logged_hours
		WHERE ts.deleted = 0";
	$result = $db->query($sql, true);
	return true;
}
