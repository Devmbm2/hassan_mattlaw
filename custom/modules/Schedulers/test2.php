<?php
/* $job_strings[] = 'sendWeeklyReportReceivedMedicalRecords'; */
sendWeeklyReportReceivedMedicalRecords();
function sendWeeklyReportReceivedMedicalRecords(){
	global $db, $app_list_strings, $sugar_config, $timedate;
	$report_data = getReportDataReceivedMedicalRecords();
	$notification = array(	
							1   =>  array('emails'=> array('meghan@mattlaw.com', 'chance@mattlaw.com', 'beth@mattlaw.com')),
							2   =>  array('emails'=> array('luisa@mattlaw.com', 'mitch@mattlaw.com')),
							3   =>  array('emails'=> array('ann@mattlaw.com', 'anita@mattlaw.com')),
							4   =>  array('emails'=> array('brian@mattlaw.com')),
							5   =>  array('emails'=> array('robert@mattlaw.com')),
							6   =>  array('emails'=> array('lisar@mattlaw.com', 'matt@mattlaw.com', 'brian@mattlaw.com', 'robert@mattlaw.com')),
					   );
	foreach($report_data as $no => $data){
		$html  = '';
		$html .= 'Here is the list of the Related Medical Records where status was changed to received in the past 7 days:';
		$html .= '<style>
				table, th, td {
				  border: 1px solid black;
				}
				</style>';
		$html .= '<table style="width:100%">
				 <thead><tr>
				 <th>Date Created</th>
				 <th>Name</th>
				 <th>Case Status</th>
				 <th>Status</th>
				 <th>Case Assigned To</th>
				 <th>Running Summary Updated</th>
				 <th>Client</th>
				 <th>Case Name</th>
				 </tr></thead><tbody>';
		foreach($data as $row){
			$html .= "<tr>
					  <td>".$timedate->to_display_date_time($row['date_entered'])."</td>
					  <td><a href=".$sugar_config['site_url']."/index.php?module=MEDR_Medical_Records&action=DetailView&record=".$row['medical_record_id'].">".$row['medical_record']."</a></td>
					  <td>".$app_list_strings['case_status_dom'][$row['case_status']]."</td>
					  <td>".$app_list_strings['medr_req_status_list'][$row['status_id']]."</td>
					  <td>".$row['user_name']."</td>
					  <td>".$row['running_summary_updated_c']."</td>
					  <td>".$row['contact_name']."</td>
					  <td>".$row['case_name']."</td>
					</tr>"; 
		}
		$html .= '</tbody></table>';
		$emailSubject = 'Weekly Report For the Received Medical Records';
		sendEmail($notification[$no]['emails'], $emailSubject, $html, '', '');
	}
}

function getReportDataReceivedMedicalRecords(){
		global $db;
		$query = "SELECT medr_medical_records.id as medical_record_id, medr_medical_records.document_name as medical_record, medr_medical_records.date_entered, CONCAT_WS(' ', contacts.first_name, contacts.last_name) as contact_name, accounts.name as accounts_name, medr_medical_records.name_of_doctor, medr_medical_records.status_id, medr_medical_records_cstm.med_summary_status_c, cases.status as case_status, CONCAT_WS(' ', users.first_name, users.last_name) as user_name, cases.name as case_name
		FROM medr_medical_records
		INNER JOIN medr_medical_records_cstm ON(medr_medical_records_cstm.id_c = medr_medical_records.id)
		INNER JOIN cases_cstm ON(medr_medical_records.deleted = 0 AND cases_cstm.contact_id1_c =  medr_medical_records.contact_id)
		INNER JOIN cases ON(medr_medical_records.deleted = 0 AND cases.id =  cases_cstm.id_c)
		INNER JOIN accounts ON(accounts.deleted = 0 AND accounts.id = medr_medical_records.account_id_c)
		INNER JOIN contacts ON(contacts.deleted = 0 AND contacts.id = medr_medical_records.contact_id)
		INNER JOIN users ON(users.deleted = 0 AND users.id = cases.assigned_user_id)
		WHERE medr_medical_records.deleted = 0 AND medr_medical_records.date_entered >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) AND medr_medical_records.status_id = 'Received'";
	$report_conditions = array(	
						1 => array('status'   => 'pre',  'assigned_user_id' => ''),  
						2 => array('status'   => '',     'assigned_user_id' => '8202dffa-afd8-2b0e-93ef-59a95bf00a77'),  //mitch
						3 => array('status'   => '',     'assigned_user_id' => '2f706d89-ee14-839e-318d-59a95cf87304'),  //anita
						4 => array('status'   => '', 	  'assigned_user_id' => '556183db-dd5d-578a-5e9e-5af4367f58b9'),  //brian
						5 => array('status'   => '',     'assigned_user_id' => '906a6a67-334e-4f2a-40b8-5d10c084af1a'),  //robert
						6 => array('status'   => 'Lit',  'assigned_user_id' => 'e4cd5835-f692-69de-3b3a-591598674c54'), //matt
					 );
	$report_data = array();
	foreach($report_conditions as $no => $condition){
		$query_range = '';
		if(isset($condition['status']) && !empty($condition['status'])){
			$query_range .= " AND cases.status LIKE '%{$condition['status']}%' ";
		}
		if(isset($condition['assigned_user_id']) && !empty($condition['assigned_user_id'])){
			$query_range .= " AND cases.assigned_user_id = '{$condition['assigned_user_id']}' ";
		}
		$final_query = $query . $query_range;
		$result = $db->query($final_query);
		while($row = $db->fetchByAssoc($result)){
			$report_data[$no][] = $row;
		}
	}
	return $report_data;
}