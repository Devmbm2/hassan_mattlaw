<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings;

$date_time = $timedate->getInstance()->nowDb();
$current_date = date('Y/m/d', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));

$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
	
		<tr border="0" style="height: 51px; color: white;border:none;">
			<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>Case Related Events Report</b></span></td>
			<td></td><td></td><td></td>
			<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
		</tr>
		
	
		
		      
    
</table>';

$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
		<thead>
		<tr>
		<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Date</strong></td>
		<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Event</strong></td>
		<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Type </strong></td>		
		<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Host</strong></td>
		<td  style="width:10%;font-size: 14px;font-weight: bold; "><strong>City</strong></td>
		<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Primary Address Street </strong></td>
		<td  style="width:10%;font-size: 14px;font-weight: bold; "><strong>Duration </strong></td>
		<td  style="width:25%;font-size: 14px;font-weight: bold; "><strong>Multiple Assigned To</strong></td>
		<td  style="width:25%;font-size: 14px;font-weight: bold; "><strong>Cancelled/Reset</strong></td>
		
		
		</tr>
		</thead>
';

$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
if($case_bean->load_relationship('cases_fp_events_1')){
$relatedBeans = "SELECT fp_events.id
				FROM fp_events
				LEFT JOIN fp_events_cstm ON(fp_events_cstm.id_c = fp_events.id)
				LEFT JOIN cases_fp_events_1_c ON(cases_fp_events_1_c.deleted = 0 AND cases_fp_events_1_c.cases_fp_events_1fp_events_idb = fp_events.id)
				WHERE fp_events.deleted = 0 AND cases_fp_events_1_c.cases_fp_events_1cases_ida = '{$_REQUEST['record']}'
				ORDER BY fp_events.date_start ASC";
$result = $db->query($relatedBeans, true);
$all_users = User::getAllUsers();   
$multiple_assigned_users_list= '';
$user_initials = get_user_initials_custom();
/* print"<pre>";print_r($user_initials);die; */
While($row = $db->fetchByAssoc($result)){
	$FP_events = BeanFactory::getBean('FP_events', $row['id']);
	/* 
	$case_status_days_field = $app_list_strings['case_status_dom_days'][$cases->status]; */
	$multiple_assigned_users_list = '';
	$multiple_assigned_users = unencodeMultienum($FP_events->multiple_assigned_users);
	foreach($multiple_assigned_users as $id){
		$multiple_assigned_users_list .= $user_initials[$id].', ';
	}
	/* $date_start = $timedate->to_display_date_time($row['date_start']); */
	$html .='<tr>
				<td><span style="font-size: 15px;">'. $FP_events->date_start . '</span></td>
				<td><span style="font-size: 15px;">'. $FP_events->name . '</span></td>
				<td><span style="font-size: 15px;">'. $GLOBALS['app_list_strings']['event_type_list'][$FP_events->type_c] . '</span></td>				 
				<td><span style="font-size: 15px;">'. $FP_events->location_name . '</span></td>
				<td><span style="font-size: 15px;">'. $FP_events->location_address_city_c . '</span></td>
				<td><span style="font-size: 15px;">'. $FP_events->primary_address_street . '</span></td>	
				<td><span style="font-size: 15px;">'. $FP_events->duration . '</span></td>
				<td><span style="font-size: 15px;">'. $multiple_assigned_users_list . '</span></td>
				<td><span style="font-size: 15px;">'. $FP_events->cancelled_reset_c . '</span></td>
				
			</tr>';	

}

}
$html .='</table>'; 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '3', '3', '3','3');

$pdf->SetHTMLHeader($header);
$pdf->AddPage('L');
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output("Case Related Events Report.pdf", 'I');