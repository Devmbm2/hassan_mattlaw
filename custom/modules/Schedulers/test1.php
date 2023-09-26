<?php

sendWeeklyReportReceivedMedicalBills();
echo 'done';echo '<br>';
function sendWeeklyReportReceivedMedicalBills(){
	global $db, $app_list_strings, $sugar_config;
	$report_data = getReportDataReceivedMedicalBills();
	print"<pre>123";print_r($report_data);
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
		$html .= 'Here is the list of the Related Received Medical Bill Records that came in the past 7 days:';
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
				 <th>Case Assigned To</th>
				 <th>Running Summary Updated</th>
				 <th>Client</th>
				 <th>case id</th>
				 </tr></thead><tbody>';
		foreach($data as $row){
			$html .= "<tr>
					  <td>".$row['date_entered']."</td>
					  <td><a href=".$sugar_config['site_url']."/index.php?module=MDOC_Incoming_Bills&action=DetailView&record=".$row['received_medical_bill_id'].">".$row['document_name']."</a></td>
					  <td>".$app_list_strings['case_status_dom'][$row['status']]."</td>
					  <td>".$row['user_name']."</td>
					  <td>".$row['running_summary_updated_c']."</td>
					  <td>".$row['contact_name']."</td>
					  <td>".$row['case_id']."</td>
					</tr>"; 
		}
		$html .= '</tbody></table>';
		$emailSubject = 'Weekly Report For the Received Medical Bills';
		/* sendEmail($notification[$no]['emails'], , $emailBody, $parent_id, $parent_type); */
		/* sendEmail('usman@helfertech.com', $emailSubject, $html, '', 'Users'); */
		/* print"<pre>";print_r($notification[$no]['emails']); */
		echo $html;echo '<br>';
	}
	
	/* print"<pre>";print_r($notification); */

}

function getReportDataReceivedMedicalBills(){
		global $db;
	$query = "SELECT mdoc_incoming_bills.id as received_medical_bill_id, mdoc_incoming_bills.document_name, mdoc_incoming_bills_cstm.contact_id_c as client, cases.id as case_id, cases.name as case_name, cases_cstm.id_c, cases.status, mdoc_incoming_bills.date_entered, users.id as user_id, CONCAT_WS(' ', users.first_name, users.last_name) as user_name, CONCAT_WS(' ', contacts.first_name, contacts.last_name) as contact_name, mdoc_incoming_bills_cstm.running_summary_updated_c
	FROM mdoc_incoming_bills 
	LEFT JOIN mdoc_incoming_bills_cstm ON(mdoc_incoming_bills.deleted = 0 AND mdoc_incoming_bills_cstm.id_c = mdoc_incoming_bills.id)
	LEFT JOIN contacts ON(contacts.deleted = 0 AND contacts.id = mdoc_incoming_bills_cstm.contact_id_c)
	LEFT JOIN cases_cstm ON(cases_cstm.contact_id1_c = mdoc_incoming_bills_cstm.contact_id_c)
	LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = cases_cstm.id_c)
	LEFT JOIN users ON(cases.deleted = 0 AND users.id = cases.assigned_user_id)
	WHERE mdoc_incoming_bills.deleted = 0 AND mdoc_incoming_bills.date_entered >= DATE_ADD(CURDATE(),INTERVAL -7 DAY)";

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