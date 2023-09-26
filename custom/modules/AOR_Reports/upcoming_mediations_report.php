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
			<td  style="width: 300px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Upcoming Mediations Report</b></span></td>
			<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
		</tr>
		
	
		<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
		      
    
</table>';
$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 800px;"><tbody>
		<thead>
		<tr>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Start Date</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Event Name </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case name</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Event Location Address</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Phone at Location </strong></span></td>
		</tr>
		<tr>
		<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
		</tr>
		</thead>
';
$sql = "SELECT fp_events.date_start, fp_events.date_end, fp_events.name as event_name, cases.name as case_name, CONCAT_WS('', first_name, last_name) as judge, cases_cstm.court_venue_c, fp_events.multiple_assigned_users, fp_events.primary_address_street, fp_events_cstm.phone_at_location_of_event_c 
FROM fp_events 
LEFT JOIN fp_events_cstm  ON (fp_events.deleted = 0 AND fp_events.id = fp_events_cstm.id_c)
LEFT JOIN cases_fp_events_1_c related_case ON (related_case.deleted = 0 AND fp_events.id= related_case.cases_fp_events_1fp_events_idb)
LEFT JOIN cases  ON (cases.deleted = 0 AND cases.id= related_case.cases_fp_events_1cases_ida)
LEFT JOIN cases_cstm  ON (cases.deleted = 0 AND cases.id = cases_cstm.id_c)
LEFT JOIN contacts  ON (contacts.deleted = 0 AND contacts.id = cases_cstm.contact_id_c)
WHERE fp_events.deleted = 0 AND fp_events.type_c IN ('Mediation') AND cases.assigned_user_id IN ('".implode("','", $cal->shared_ids)."')
AND fp_events.date_start > CURDATE() AND fp_events.date_start < DATE_ADD(CURDATE(), INTERVAL 12 MONTH) 
AND fp_events.date_end > CURDATE() 
AND fp_events.date_end < DATE_ADD(CURDATE(), INTERVAL 12 MONTH)
ORDER BY fp_events.date_start ASC";

$result = $db->query($sql, true);
while($row = $db->fetchByAssoc($result)){
	 $date_start = $timedate->to_display_date_time($row['date_start']);
	 $multiple_assigned_users   = unencodeMultienum($row['multiple_assigned_users']);
	 $multiple_assigned = array();
	 foreach($multiple_assigned_users AS $user_id){
		$multiple_assigned[] = get_user_name($user_id);
	 }
	 $attorney = implode(', ', $multiple_assigned);
	 
$html .='
		<tr>
		<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
		</tr>
		<tr>
			<td ><span style="font-size: 10px;">'. $date_start . '</span></td>
			<td ><span style="font-size: 10px;">'. $row['event_name'] . '</span></td>
			<td ><span style="font-size: 10px;">'. $row['case_name'] . '</span></td>
			<td ><span style="font-size: 10px;">'. $row['primary_address_street'] . '</span></td>
			<td ><span style="font-size: 10px;">'. $row['phone_at_location_of_event_c'] . '</span></td>
		</tr>';	
}
$html .='</tbody></table>'; 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '30', '0', '0', '0','0');
$pdf->SetHTMLHeader($header);
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output("Upcoming Trials & Vacations Report.pdf", 'I');