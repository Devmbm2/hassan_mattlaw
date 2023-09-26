<?php
$total_cases_opens_report = new total_cases_opens_report();
$total_cases_opens_report->generatetotal_cases_opens_reportHTML('I');
class total_cases_opens_report{

	function generatetotal_cases_opens_reportHTML($pdf_type = 'I'){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;
		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));
		$sql = "SELECT cases.date_entered, cases.name, cases.state, cases.status, cases.date_of_incident_c, CONCAT_WS(' ', users.first_name, users.last_name) as 'user name', cases_cstm.mdp_estimated_case_value_c 
				FROM cases 
				LEFT JOIN cases_cstm ON(cases.deleted = 0 AND cases_cstm.id_c = cases.id)
				LEFT JOIN users ON(cases.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE cases.deleted = 0 AND cases.state = 'Open' AND DATE(cases.date_entered) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
				ORDER BY cases.date_entered DESC ";     
		$result = $db->query($sql, true);
		$header = '<table style="table-layout: fixed;height: 60px; width: 900px;border-spacing: 10px" border="0">
				
					<tr border="0" style="height: 51px; color: white;">
						<td style="width: 232px; height: 51px;"><span style="color:black;font-size:15px;"><b>Open Cases Weekly Report</b></span></td>
						<td style="width: 232px; height: 51px;"><span style="color:black;font-size:15px;"><b>Total: '. $result->num_rows .'</b></span></td>
				
						<td  style="width: 253px; height: 51px;"><span style="color:black;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
					</tr>
					<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
					</table>';

		$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 900px;" border="1"><tbody>
				<thead>
				<tr>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Date Created</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Name</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>State</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Status</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Date Of Incident</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Assigned Lawyer</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>MDP Est Value </strong></span></td>
				</tr>
				<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
				</thead>
		';


		while($row = $db->fetchByAssoc($result)){
			$html .='<tr>
						<td ><span style="font-size: 12px;">'. $timedate->to_display_date_time($row['date_entered']) . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_state_dom'][$row['state']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_status_dom'][$row['status']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $timedate->to_display_date_time($row['date_of_incident_c']) . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['user name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['mdp_estimated_case_value_c'] . '</span></td>
					</tr>';
					$html .='
					<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
					';
		}
		$html .='</tbody></table>'; 
		$pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', '10', '10', '25', '6', '0', '0','0');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		ob_clean();
		if($pdf_type == 'I'){
			$pdf->Output("Open Cases Weekly Report.pdf", $pdf_type);				
		}else{
			if (!file_exists('cache/custom_reports')) {
				mkdir('cache/custom_reports', 0777, true);
			}
			$pdf->Output("cache/custom_reports/Open Cases Weekly Report.pdf", $pdf_type);				
		}
	}	
}