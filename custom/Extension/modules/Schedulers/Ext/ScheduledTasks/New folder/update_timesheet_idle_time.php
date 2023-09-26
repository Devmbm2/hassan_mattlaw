<?php 
$job_strings[] = 'update_timesheet_idle_time';

function update_timesheet_idle_time(){
	global $db,$log, $timedate;
	
	$sql = "SELECT id, DATE(login) AS login_date, created_by 
	FROM ht_timesheet
	WHERE deleted = 0 AND login IS NOT NULL AND (DATE(login) > (NOW() - INTERVAL 7 DAY)) 
	ORDER BY login ASC ";
	
	$result = $db->query($sql, true);
	while($row = $db->fetchByAssoc($result)){
		$id = $row['id'];
		$created_by = $row['created_by'];
		$login_date = $row['login_date'];
		$dates = $timedate->getDayStartEndGMT($login_date);
		$field_start = $db->convert($dates["start"], "datetime");
		$field_end = $db->convert($dates["end"], "datetime");
		$sql_idle = "SELECT SUM(TIME_TO_SEC(TIME_FORMAT(d.diff, '%H:%i:%s')))/3600 AS diff
		FROM ( SELECT TIMEDIFF(TIME_FORMAT(t.date_entered, '%H:%i:%s'),@pvalue) AS diff, TIME_FORMAT(t.date_entered, '%H:%i:%s')as date_e, @pvalue as pre, t.date_entered, t.created_by
			  , @pvalue := TIME_FORMAT(t.date_entered, '%H:%i:%s')
		   FROM usersactivity t
		  CROSS
		   JOIN ( SELECT @pvalue := NULL ) i
					WHERE t.deleted = 0 AND (t.created_by in ('{$created_by}') ) 
					AND ( (t.date_entered >= '{$field_start}' 
					AND t.date_entered <= '{$field_end}')) 
					ORDER BY t.date_entered ASC
		) d
		where TIME_TO_SEC(d.diff) > 900 ";
		$result_idle = $db->query($sql_idle, true);
		$row_idle = $db->fetchByAssoc($result_idle);
		if($row_idle)
		{
		$update_sql = "UPDATE ht_timesheet SET idle_time = '{$row_idle['diff']}' WHERE id= '{$id}'";
		$db->query($update_sql, true);
	}
	}
	return true;
}
