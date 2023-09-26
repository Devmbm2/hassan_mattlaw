<?php
$job_strings[] = 'sendOverDueTasksReport';
function sendOverDueTasksReport()
{
	set_time_limit(9000);
	ini_set('memory_limit', '2048M'); //blacklist while package scan
	global $db, $app_list_strings, $sugar_config, $timedate, $log;
	$report_data = getDueTasksReportData();
	$notification_emails = array('ht.saeed5@gmail.com' , 'matt@mattlaw.com');
	$html  = '';
	$html .= 'Here is the list of the of OverDue Tasks:';
	$html .= '<style>
			table, th, td {
			  border: 1px solid black;
			}
			</style>';
	$html .= '<table style="width:100%">
			 <thead><tr>
			 <th style="text-align:left;">Due Date</th>
			 <th style="text-align:left;">Task Name</th>
			 <th style="text-align:left;">Case Name</th>
			 <th style="text-align:left;">Case Status</th>
			 <th style="text-align:left;">Assigned Attorney</th>
			 </tr></thead><tbody>';
	foreach($report_data as $row){
		$html .= "<tr>
				  <td>".$timedate->to_display_date_time($row['date_due'])."</td>
				  <td><a href=".$sugar_config['site_url']."/index.php?module=Tasks&action=DetailView&record=".$row['task_id'].">".$row['task_name']."</a></td>
				  <td><a href=".$sugar_config['site_url']."/index.php?module=Cases&action=DetailView&record=".$row['case_id'].">".$row['case_name']."</a></td>
				  <td>".$app_list_strings['case_status_dom'][$row['case_status']]."</td>
				  <td>".$row['user_name']."</td>
				</tr>"; 
	}
	$html .= '</tbody></table>';
	$emailSubject = 'OverDue Tasks Report';
	sendEmail($notification_emails, $emailSubject, $html, '', '');
	return true;
}

function getDueTasksReportData(){
	global $db;
	$query = "SELECT t.id AS task_id, t. NAME AS task_name, t.date_due, c.id AS case_id, c. NAME AS case_name, c. STATUS AS case_status, CONCAT_WS( ' ', users.first_name, users.last_name) AS user_name FROM tasks t INNER JOIN cases c ON( c.deleted = 0 AND c.id = t.parent_id AND t.parent_type = 'Cases' ) INNER JOIN users ON ( users.deleted = 0 AND users.id = c.assigned_user_id AND users.`status` = 'Active' ) WHERE t.deleted = 0 AND t. STATUS = 'overdue' AND t.date_due IS NOT NULL AND t.date_due != '' ORDER BY user_name, case_name, date_due, task_name";
	$result = $db->query($query);
	$report_data = array();
	while($row = $db->fetchByAssoc($result)){
		$report_data[] = $row;
	}
	return $report_data;
}
