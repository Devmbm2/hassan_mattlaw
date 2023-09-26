<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings;

$date_time = $timedate->getInstance()->nowDb();
$current_date = date('Y/m/d', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));

$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
	
		<tr>
		<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
		</tr>
		<tr border="0" style="height: 51px; color: white;border:none;">
			<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Complaint Related Events Report</b></span></td>
			<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
		</tr>
		
	
		<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
		      
    
</table>';

$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 800px;"><tbody>
		<thead>
		<tr>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Date</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Event</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Type </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Host</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>City</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Primary Address Street </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Memo</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Duration </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Multiple Assigned To</strong></span></td>
		</tr>
		</thead>
';

$complaint_bean = BeanFactory::getBean('Complaints', $_REQUEST['record']);
if($complaint_bean->load_relationship('complaints_fp_events_1')){
$relatedBeans = "SELECT * 
				FROM fp_events
				LEFT JOIN fp_events_cstm ON(fp_events_cstm.id_c = fp_events.id)
				LEFT JOIN complaints_fp_events_1_c ON(complaints_fp_events_1_c.deleted = 0 AND complaints_fp_events_1_c.complaints_fp_events_1fp_events_idb = fp_events.id)
				WHERE fp_events.deleted = 0 AND complaints_fp_events_1_c.complaints_fp_events_1complaints_ida = '{$_REQUEST['record']}'
				ORDER BY fp_events.date_start ASC";
$result = $db->query($relatedBeans, true);
$all_users = User::getAllUsers();   
$multiple_assigned_users_list= '';
While($row = $db->fetchByAssoc($result)){
	/* $complaints = BeanFactory::getBean('Complaints', $row['id']);
	$complaint_status_days_field = $app_list_strings['complaint_status_dom_days'][$complaints->status]; */
	$multiple_assigned_users = unencodeMultienum($row['multiple_assigned_users']);
	foreach($multiple_assigned_users as $id){
		$multiple_assigned_users_list .= $all_users[$id].', ';
	}
	$date_start = $timedate->to_display_date_time($row['date_start']);
	$html .='<tr>
				<td ><span style="font-size: 12px;">'. $date_start . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['name'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['type_c'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['location_name'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['location_address_city_c'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['primary_address_street'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['description'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $row['duration'] . '</span></td>
				<td ><span style="font-size: 12px;">'. $multiple_assigned_users_list . '</span></td>
				
			</tr>';	

}

}
$html .='</tbody></table>'; 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '30', '0', '0', '0','0');

$pdf->SetHTMLHeader($header);
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output("Complaint Related Events Report.pdf", 'I');