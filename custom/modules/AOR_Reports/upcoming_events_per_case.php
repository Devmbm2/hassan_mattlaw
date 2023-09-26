<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings, $shared_ids;
require_once('modules/Calendar/Calendar.php');
$cal = new Calendar();
$cal->init_shared();   
$date_time = $timedate->getInstance()->nowDb();
$current_date = date('Y/m/d', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));

$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
	
		<tr>
		<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
		</tr>
		<tr border="0" style="height: 51px; color: white;border:none;">
			<td  style="width: 300px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Upcoming Events per Case</b></span></td>
			<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
		</tr>
		
	
		<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
		      
    
</table>';

$sql = "SELECT fp_events.date_start, fp_events.date_end, fp_events.name as event_name, cases.name as case_name, cases.id as case_id, CONCAT_WS('', first_name, last_name) as judge, cases_cstm.court_venue_c, fp_events.multiple_assigned_users, fp_events.primary_address_street, fp_events_cstm.phone_at_location_of_event_c, fp_events.type_c as event_type 
FROM fp_events 
LEFT JOIN fp_events_cstm  ON (fp_events.deleted = 0 AND fp_events.id = fp_events_cstm.id_c)
LEFT JOIN cases_fp_events_1_c related_case ON (related_case.deleted = 0 AND fp_events.id= related_case.cases_fp_events_1fp_events_idb)
LEFT JOIN cases  ON (cases.deleted = 0 AND cases.id= related_case.cases_fp_events_1cases_ida)
LEFT JOIN cases_cstm  ON (cases.deleted = 0 AND cases.id = cases_cstm.id_c)
LEFT JOIN contacts  ON (contacts.deleted = 0 AND contacts.id = cases_cstm.contact_id_c)
WHERE fp_events.deleted = 0 AND cases.assigned_user_id IN ('".implode("','", $cal->shared_ids)."')
AND fp_events.date_start > CURDATE() AND fp_events.date_start < DATE_ADD(CURDATE(), INTERVAL 12 MONTH) 
AND fp_events.date_end > CURDATE() 
AND fp_events.date_end < DATE_ADD(CURDATE(), INTERVAL 12 MONTH)
ORDER BY fp_events.date_start ASC";

$result = $db->query($sql, true);
$event_data = array();
$event_cases = array();
while($row = $db->fetchByAssoc($result)){
	 $row['date_start'] = $timedate->to_display_date_time($row['date_start']);
	 $multiple_assigned_users   = unencodeMultienum($row['multiple_assigned_users']);
	 $multiple_assigned = array();
	 $all_users = get_users();
	 foreach($multiple_assigned_users AS $user_id){
		$multiple_assigned[] = $all_users[$user_id];
	 }
	 $multiple_assigned = implode(', ', $multiple_assigned);
	 $row['multiple_assigned'] = $multiple_assigned;
	 $event_data[$row['case_id']][] = $row;
	 $event_cases[$row['case_id']] = $row['case_name'];
}
asort($event_cases);
$html = '';
foreach($event_cases as $case_id => $case_name){
$row = 
$html .= '<b>'. $case_name .'</b>';	
$html .= '<table border = "1" style="table-layout: fixed;margin-top:25px;height: 60px; width: 800px;">
		<thead>
		<tr>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Start Date</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case name</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Event Name </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Event Type</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Assigned Lawyer </strong></span></td>
		</tr>
		</thead>
		';
	$data = $event_data[$case_id];
	foreach($data as $no => $events){
		$html .='
				<tr border = "0">
					<td ><span style="font-size: 10px;">'. $events['date_start'] . '</span></td>
					<td ><span style="font-size: 10px;">'. $events['case_name'] . '</span></td>
					<td ><span style="font-size: 10px;">'. $events['event_name'] . '</span></td>
					<td ><span style="font-size: 10px;">'. $events['event_type'] . '</span></td>
					<td ><span style="font-size: 10px;">'. $events['multiple_assigned'] . '</span></td>
				</tr>';	
		
	}
	$html .='</table><br>';
}
 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '20', '0', '0', '0','0');
$pdf->SetHTMLHeader($header);
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output("Upcoming Trials & Vacations Report.pdf", 'I');