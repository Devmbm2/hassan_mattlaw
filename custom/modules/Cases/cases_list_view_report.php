<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings;

$date_time = $timedate->getInstance()->nowDb();
$current_date = date('Y/m/d', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));
/* print"<pre>";print_r($_REQUEST['mass']);die; */
$first_name = explode(" ", $current_user->first_name);
$last_name = explode(" ", $current_user->last_name);
$string = array_merge($first_name, $last_name);
foreach($string as $w){
	$inials .= strToUpper($w[0]);
}

$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
	
		<tr>
		<td style=" padding:-50px 0px 0px 0px;border-bottom:1px solid black;" colspan="100%"></td>
		</tr>
		<tr border="0" style="height: 51px; color: white;border:none;">
			<td  style="width: 231px; height: 51px;border:none;"><span style="color:black;font-size:10px;">Filters Used:</span><br><span style="color:black;font-size:10px;"><b>'.$_REQUEST['selectCount'][0].' Tagged Records</b></span></td>
			<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:20px;"><b>Case Report</b></span></td>
			<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
		</tr>
		<tr border="0" style="height: 0px;">
			<td  style="width: 231px; height: 0px;border:none;">&nbsp;</td>
			<td  style="width: 232px; height: 0px;border:none;"><span style="color:black;font-size:10px;">&nbsp;</td>
			<td  style="width: 253px; height: 0px;border:none;"><span style="color:black;float:right;font-size:10px;">Printed By:</span><span style="color:black;float:right;font-size:10px;"><strong>'.$inials .' </strong></span></td>
		</tr>
		
	
		<tr><td style=" padding:0px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
		      
    
</table>';

$html = '<table style="table-layout: fixed;margin-top:25px;height: 60px; width: 800px;"><tbody>
		<thead>
		<tr>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Date Created</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case Name</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Date Of Incident</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Total Case Length</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case Type </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Insurance</strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Injured Person </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Assigned Lawyer </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case Status </strong></span></td>
		<td style="font-weight: bold; "><span style="font-size: 10px;"><strong>Case Status Days</strong></span></td>
		</tr>
		</thead>
';

$sql = "SELECT *
		FROM cases
		LEFT  JOIN cases_cstm ON(cases.deleted = 0 AND cases_cstm.id_c = cases.id )
		WHERE deleted = 0 AND cases.id IN ('".implode("','", $_REQUEST['mass'])."')
		ORDER BY cases.name ASC
		";   
$result = $db->query($sql, true);
while($row = $db->fetchByAssoc($result)){
	$cases = BeanFactory::getBean('Cases', $row['id']);
	$case_status_days_field = $app_list_strings['case_status_dom_days'][$cases->status];
	
	$html .='<tr>
				<td ><span style="font-size: 12px;">'. $cases->date_entered . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->name . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->date_of_incident_c . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->total_case_length_c . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->type . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->case_insurance_summary_c . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->injured_person_c . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->assigned_user_name . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->status . '</span></td>
				<td ><span style="font-size: 12px;">'. $cases->$case_status_days_field . '</span></td>
				
			</tr>
			
			<tr>
			  <td colspan=8><span style="font-size: 11px;"><b>'. $cases->case_description_c .'</b></span></td><br>
			</tr>';	
			if (strpos($cases->type, "Companion") == true){
				if($cases->load_relationship('comp_companions_cases')){
					$relatedBeans = $cases->comp_companions_cases->getBeans();
					if(!empty($relatedBeans)){
						$html .='<tr>
									<td colspan=8><span style="font-size: 12px;"><b>Companions List:</b></span></td>
								</tr>';
					}
					foreach($relatedBeans as $no => $data){
						$html .='<tr>
						<td colspan=8><span style="font-size: 13px;">'. $data->name .'</span></td>
						</tr>';
					}
				}
			}
			$html .='
			<tr><td style=" padding:-50px 0px 0px 0px;border-bottom:0.5px solid black"colspan="100%"></td></tr>
			';
			
	
}


$html .='</tbody></table>'; 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '30', '0', '0', '0','0');
/* $pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', '10', '10', '2', '6', '-3', '-3','0'); */

$pdf->SetHTMLHeader($header);
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output("Cases Report.pdf", 'I');