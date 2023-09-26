<?php 
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = '39d8d6e4-9817-dbe8-9c62-5b57411dcd37'; */
global $db;

$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['record_id']);

if($contact_bean->load_relationship('cases')){
	$relatedBeans = $contact_bean->cases->getBeans();
	reset($relatedBeans);
	$case = current($relatedBeans);
}


$header = '<table style="height: 60px; width: 1100px; ">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $contact_bean->first_name .' '.$contact_bean->last_name .'</strong></span></td>
<td>
</td>
<td style="text-align:right;font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0); "> <span style="font-size: 12px;">Date Of Incident:</span> '.$case->date_of_incident_c .'</td>
</tr>
<tr>
<td style="font-family:Times,serif;font-size:9px;color:rgb(0,0,0);text-align: left;font-weight: bold; text-align: left;"><span style="font-size: 14px;">
Medical Bill Summary</span>
</strong></td>
</tr><br>


</tbody>
</table>






';
$header .='<table style="height: 60px; width: 1100px;"><tbody>
<tr>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Medical Provider</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Total Charges</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > PIP Paid</span></td>
<td style="text-align: center;">  <span  style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Medicare Paid</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Medicaid Paid</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Health Ins Paid</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Workers Comp Paid:</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Adjustment</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Client Paid</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Reduced To:</span></td>
<td style="text-align: center;"> <span   style="font-family:Times,serif;font-size:14px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none" > Balance</span></td>

</tr><tr><td style=" padding:0px 0px 0px 0px;border-bottom:2px solid black" colspan="12"></td></tr>';
$html = $header;
if($contact_bean->load_relationship('medb_medical_bills_contacts')){
	
	$relatedBeans = $contact_bean->medb_medical_bills_contacts->getBeans();
	$total_charges_total = 0;
	$pip_paid_total = 0;
	$medicare_paid_total = 0;
	$medicaid_paid_total = 0;
	$health_insurance_paid_total = 0;
	$adjustments_total = 0;
	$client_paid_total = 0;
	$reduction_amount_total = 0;
	$balance_total = 0;
	$len = count($relatedBeans);
	$i = 0;
	$where_medical_provider = '';
	if(isset($_REQUEST['medical_providers_bill']) && !empty($_REQUEST['medical_providers_bill']) && $_REQUEST['medical_providers_bill'] != null){
		$_REQUEST['medical_providers_bill'] = explode(',',$_REQUEST['medical_providers_bill']);
		
		$where_medical_provider = " medb_medical_bills.account_id_c IN ('".implode("','", $_REQUEST['medical_providers_bill'])."')";		
	}
	
	$query = "SELECT medb_medical_bills.id, medb_medical_bills.document_name 
			FROM medb_medical_bills
			LEFT JOIN medb_medical_bills_cstm ON (medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_cstm.id_c)
			LEFT JOIN  medb_medical_bills_contacts_c ON (medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb = medb_medical_bills.id)
			WHERE medb_medical_bills.deleted = 0  AND {$where_medical_provider} AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$_REQUEST['record_id']}' order by medb_medical_bills.document_name ASC";
	/* echo $query;die; */1
	$result = $GLOBALS['db']->query($query, true);
	$ids = array();
	while($row = $GLOBALS['db']->fetchByAssoc($result)){
		$ids[] = $row['id'];
	}
	/* print"<pre>";print_r($_REQUEST['medical_providers_bill']);die; */
foreach($ids as $no => $id){
		$data = BeanFactory::getBean('MEDB_Medical_Bills', $id);
		$total_charges_total += $data->total_charges;
		$pip_paid_total += $data->pip_paid;
		$medicare_paid_total += $data->medicare_paid;
		$medicaid_paid_total += $data->medicaid_paid;
		$health_insurance_paid_total += $data->health_insurance_paid;
		$adjustments_total += $data->adjustments;
		$client_paid_total += $data->client_paid;
		$reduction_amount_total += $data->reduction_amount;
		$workers_comp_paid_total += $data->workers_comp_paid;
		$balance_total += $data->balance;
		
		$total_charges = empty($data->total_charges) ? 0:$data->total_charges;
		$pip_paid = empty($data->pip_paid) ? 0:$data->pip_paid;
		$medicare_paid = empty($data->medicare_paid) ? 0:$data->medicare_paid;
		$medicaid_paid = empty($data->medicaid_paid) ? 0:$data->medicaid_paid;
		$health_insurance_paid = empty($data->health_insurance_paid) ? 0:$data->health_insurance_paid;
		$adjustments = empty($data->adjustments) ? 0:$data->adjustments;
		$client_paid = empty($data->client_paid) ? 0:$data->client_paid;
		$reduction_amount = empty($data->reduction_amount) ? 0:$data->reduction_amount;
		$comp_paid = empty($data->workers_comp_paid) ? 0:$data->workers_comp_paid;
		$balance = empty($data->balance) ? 0:$data->balance;
		$html .='
				
				<tr>
					
					<td style="text-align: left;"><span style="text-align: right;font-family:Times;font-size: 14px;">' . $data->name .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$' . number_format($total_charges, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($pip_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($medicare_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($medicaid_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($health_insurance_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($comp_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($adjustments, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($client_paid, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($reduction_amount, 2) .'</span></td>			
					<td style="text-align: right;"><span style="text-align: right;font-family:Times;font-size: 14px;">$'. number_format($balance, 2) .'</span></td>				
				</tr>
				
				
				
				';
				if ($i != $len - 1) {
					$html .='<tr><td style=" padding:0px 0px 0px 0px;border-bottom:1px solid black" colspan="12"></td></tr>';
				}
				$i++;
	}
	$html .='
	<tr><td style=" padding:0px 0px 0px 0px;border-bottom:2px solid black" colspan="12"></td></tr>;
	<tr>		
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">&nbsp;</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($total_charges_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($pip_paid_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($medicare_paid_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($medicaid_paid_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($health_insurance_paid_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($workers_comp_paid_total, 2).'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($adjustments_total, 2) .'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($client_paid_total, 2).'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($reduction_amount_total, 2).'</span></td>			
		<td style="text-align: right;"><span style="text-align: right;font-family: Times, serif;font-size: 14px;font-weight:bold;">$'. number_format($balance_total, 2) .'</span></td>			
	</tr>';
}
$html .='
</tbody></table>';
/* echo $html;die; */
$pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', 10, 10, 10, 16, 9, 9);
$pdf->AddPage('L');
/* $pdf->SetHTMLHeader($header); */
$pdf->WriteHTML($html);

$pdf->Output();
ob_clean();
$pdf->Output("Medical Bill Summary Report.pdf", 'I');