<?php
$total_new_leads_report = new total_new_leads_report();
$total_new_leads_report->generateTotal_new_leads_reportReportHTML('I');
class total_new_leads_report{

	function generateTotal_new_leads_reportReportHTML($pdf_type = 'I'){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;
		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));
		$sql = "SELECT * 
				FROM leads 
				LEFT JOIN leads_cstm ON(leads.deleted = 0 AND leads_cstm.id_c = leads.id)
				WHERE leads.deleted = 0 AND DATE(leads.date_entered) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
				ORDER BY leads.date_entered DESC ";     
		$result = $db->query($sql, true);
		$header = '<table style="table-layout: fixed;height: 60px; width: 900px;border-spacing: 10px" border="0">
				
					<tr border="0" style="height: 51px; color: white;">
						<td style="width: 232px; height: 51px;"><span style="color:black;font-size:15px;"><b>New Leads Weekly Report</b></span></td>
						<td style="width: 232px; height: 51px;"><span style="color:black;font-size:15px;"><b>Total: '. $result->num_rows .'</b></span></td>
				
						<td  style="width: 253px; height: 51px;"><span style="color:black;font-size:15px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:15px;">Time Printed:<b>'.$current_time.'</b></span></td>
					</tr>
					<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
					</table>';

		$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 900px;" border="1"><tbody>
				<thead>
				<tr>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Date Created</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Lead</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Case Type </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Source  </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Mobile </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Office Phone  </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Other Phone </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Damages</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 11px;"><strong>Converted</strong></span></td>
				</tr>
				<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
				</thead>
		';


		while($row = $db->fetchByAssoc($result)){
			$html .='<tr>
						<td ><span style="font-size: 12px;">'. $timedate->to_display_date_time($row['date_entered']) . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['first_name'] .' '.$row['last_name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_type_list'][$row['case_type_c']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_source_list'][$row['source_c']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['phone_mobile'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['phone_work'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['phone_other'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['damages_list'][$row['damages_c']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['converted'] . '</span></td>
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
			$pdf->Output("Total New Leads Report.pdf", $pdf_type);				
		}else{
			if (!file_exists('cache/custom_reports')) {
				mkdir('cache/custom_reports', 0777, true);
			}
			$pdf->Output("cache/custom_reports/Total New Leads Report.pdf", $pdf_type);				
		}
	}	
}