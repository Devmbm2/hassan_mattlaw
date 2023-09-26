<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = 'b96c5646-8c3f-8056-d1c4-5b3a022aace9'; */
global $db;

$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['record_id']);
if($contact_bean->load_relationship('cases')){
	$relatedBeans = $contact_bean->cases->getBeans();
	reset($relatedBeans);
	$case = current($relatedBeans);
}


$header = '
<style>
@media print {
    tr {
        display: block;
        page-break: auto;
    }
}
</style>
&nbsp;<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>Medical Record Summary</strong></span></td>
<td style="font-weight: bold; padding: 10px 5px 20px 145px; text-align: left;"><strong>                                             </strong></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $contact_bean->name .'</strong></span></td>
</tr>
<tr>
<td style="font-size: 11px;"><span style="font-size: 12px;">      Date</span></td>
<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px;">Description</span></td>
<td style="font-size: 12px; text-align: left;"> <span style="font-size: 12px;">Date Of Incident:</span> '.$case->date_of_incident_c .'</td>
</tr><tr ></tr>
</tbody>
</table>';

$html = $header.'<table style="height: 60px; width: 790px;"><tbody>';
if($contact_bean->load_relationship('mts_medical_treatment_summary_contacts')){
	$where_medical_provider = '';
	$where_medical_provider_organization = '';
	$date_filter = '';
	$where = '';
	/* print"<pre>";print_r($_REQUEST['medical_providers']); */
	if(isset($_REQUEST['medical_providers']) && !empty($_REQUEST['medical_providers']) && $_REQUEST['medical_providers'] != 'null'){
		$_REQUEST['medical_providers'] = explode(',', $_REQUEST['medical_providers']);
		$where_medical_provider = " AND mts_medical_treatment_summary.contact_id_c IN ('".implode("','", $_REQUEST['medical_providers'])."')";
		/* echo $where_medical_provider;die; */		
	}
	if(isset($_REQUEST['medical_provider_organizations']) && !empty($_REQUEST['medical_provider_organizations']) && $_REQUEST['medical_provider_organizations'] != 'null'){
		$_REQUEST['medical_provider_organizations'] = explode(',',$_REQUEST['medical_provider_organizations']);
		$where_medical_provider_organization = " AND mts_medical_treatment_summary.account_id_c IN ('".implode("','", $_REQUEST['medical_provider_organizations'])."')";		
	}
	if(isset($_REQUEST['start_date']) && !empty($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && !empty($_REQUEST['end_date'])){
		$date_filter = " AND mts_medical_treatment_summary.treatment_date >= '{$_REQUEST['start_date']}' AND mts_medical_treatment_summary.treatment_date <= '{$_REQUEST['end_date']}'";		
	}
	$where = $where_medical_provider. $where_medical_provider_organization. $date_filter;
		$sql = "SELECT mts_medical_treatment_summary.document_name, mts_medical_treatment_summary.treatment_date, mts_medical_treatment_summary.treatment_description_summary, mts_medical_treatment_summary.description, accounts.name as medical_provider_organization, CONCAT_WS('', medical_provider_person.first_name, medical_provider_person.last_name) as medical_provider_person
		FROM `mts_medical_treatment_summary`
		LEFT JOIN mts_medical_treatment_summary_contacts_c ON (mts_medical_treatment_summary_contacts_c.deleted=0 AND mts_medical_treatment_summary.id = mts_medical_treatment_summary_contacts_c.mts_medicafdf2summary_idb)
		LEFT JOIN contacts ON (contacts.deleted = 0 AND  mts_medical_treatment_summary_contacts_c.mts_medical_treatment_summary_contactscontacts_ida = contacts.id)
		LEFT JOIN accounts ON(accounts.deleted=0 AND accounts.id = mts_medical_treatment_summary.account_id_c)
		LEFT JOIN contacts as medical_provider_person ON(medical_provider_person.deleted=0 AND medical_provider_person.id = mts_medical_treatment_summary.contact_id_c)
		WHERE contacts.id = '{$_REQUEST['record_id']}' {$where}
		ORDER BY mts_medical_treatment_summary.treatment_date ASC";
		/* echo $sql;die; */
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$name = explode('.', $row['document_name']);	
			$name = $name[0];
			if(strlen($row["treatment_description_summary"])<7500){
				$html .='<tr><td style=" padding:30px 0px 0px 0px;border-bottom:1px solid black" colspan="2"></td></tr>
					<tr>
					<td style="padding:4px 0px 0px 0px;   text-align: left; width: 280px; height: 0px;"><span style="font-size: 17px;">'. $row['treatment_date'] .'</span><br><span style="font-size: 17px;">'.$row['medical_provider_organization'] .'</span><br><span style="font-size: 17px;">'. $row['medical_provider_person'] .'</span><br><br><span style="font-size: 14px;"><strong>'. $name. '</strong></span></td>
			<td style="text-align: left; width: 100%; height: 100%;"><span style="font-size: 18px;">'. $row["treatment_description_summary"] .'</span></td>			
			</tr>';
			}
			else{
				$html .='<tr><td style=" padding:30px 0px 0px 0px;border-bottom:1px solid black" colspan="2"></td></tr>
					<tr>
					<td style="padding:4px 0px 0px 0px;   text-align: left; width: 280px; height: 0px;"><span style="font-size: 17px;">'. $row['treatment_date'] .'</span><br><span style="font-size: 17px;">'.$row['medical_provider_organization'] .'</span><br><span style="font-size: 17px;">'. $row['medical_provider_person'] .'</span><br><br><span style="font-size: 14px;"><strong>'. $name. '</strong></span></td>
			<td style="text-align: left; width: 100%; height: 100%;"><span style="font-size: 12px;">'. $row["treatment_description_summary"] .'</span></td>			
			</tr>';
			}	
			
		}   
}

$html .='</tbody></table>';

$pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', 10, 10, 10, 16, 9, 9);
$pdf->AddPage();
$pdf->WriteHTML($html);

$pdf->Output();
ob_clean();
$pdf->Output("Medical Record Summary.pdf", 'I');