<?php
$customReportEndYearCost = new customReportEndYearCost();
$customReportEndYearCost->generateEndYearCostReportHTML('I');
class customReportEndYearCost{

	function generateEndYearCostReportHTML($pdf_type = 'I'){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;
		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 900px;" border="0">
					<tr>
					<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
					</tr>
					<tr border="0" style="height: 51px; color: white;border:none;">
						<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>End of Year Cost Report</b></span></td>
						<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
					</tr>
					<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
					</table>';

		$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 900px;"><tbody>
				<thead>
				<tr>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Case Name</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Total Case Length</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Case Type </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Insurance</strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Injured Person </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Assigned Lawyer </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Case Status </strong></span></td>
				<td style="font-weight: bold; "><span style="font-size: 9px;"><strong>Total Cost</strong></span></td>
				</tr>
				<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
				</thead>
		';

		$sql = "SELECT *
				FROM cases
				LEFT  JOIN cases_cstm ON(cases.deleted = 0 AND cases_cstm.id_c = cases.id )
				WHERE cases.deleted = 0 AND cases.status NOT IN ('Referred_Out', 'Adiosed', 'Pending_Reductions',  'Pending_Signed_Closing', 'Pending_Adios', 'Closed')
				ORDER BY cases.name ASC
			";     
		$result = $db->query($sql, true);
		$totalCostAllCases = 0;
		while($row = $db->fetchByAssoc($result)){
			$totalCost = $this->getRelatedCaseTotalCost($row['id']);
			$totalCostAllCases += $totalCost;
			$html .='<tr>
						<td ><span style="font-size: 12px;">'. $row['name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['total_case_length_c'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_type_list'][$row['type']] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['case_insurance_summary_c'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['injured_person_c'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $row['assigned_user_name'] . '</span></td>
						<td ><span style="font-size: 12px;">'. $app_list_strings['case_status_dom'][$row['status']] . '</span></td>
						<td ><span style="font-size: 12px;">$'. $totalCost . '</span></td>
					</tr>
					
					<tr>
					  <td colspan=8><span style="font-size: 11px;"><b>'. $cases->case_description_c .'</b></span></td><br>
					</tr>';
					$html .='
					<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
					';
		}
		$html .='
				<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
				<tr>
					  <td><span style="font-size: 11px;"><b>Total Cost</b></span></td><br>
					  <td colspan=8 align= "right"><span style="font-size: 11px;"><b>$'. $totalCostAllCases .'</b></span></td><br>
				</tr>
				';
		$html .='</tbody></table>'; 
		$pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', '10', '10', '25', '6', '0', '0','0');
		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		ob_clean();
		if($pdf_type == 'I'){
			$pdf->Output("End Year Cost Report.pdf", $pdf_type);				
		}else{
			$pdf->Output("cache/custom_reports/End Year Cost Report.pdf", $pdf_type);				
		}
	}
	function getRelatedCaseTotalCost($case_id){
		global $db;
		$total_cost = 0;
		$cases = BeanFactory::getBean('Cases', $case_id);
		$sql = "SELECT cost_client_cost.status, cost_client_cost.total_amount
				FROM `cost_client_cost`
				LEFT JOIN cost_client_cost_cases_c ON (cost_client_cost.deleted = 0 AND cost_client_cost.id = cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb)
				WHERE cost_client_cost_cases_c.deleted = 0 and cost_client_cost_cases_c.cost_client_cost_casescases_ida = '{$case_id}' AND cost_client_cost.status IN ('Paid_by_Check', 'Paid_by_Credit_Card')";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$total_cost += $row['total_amount'];
		}
		return $total_cost;
	}	
}