<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = 'b96c5646-8c3f-8056-d1c4-5b3a022aace9'; */
$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['id']);
if($contact_bean->load_relationship('cases')){
	$relatedBeans = $contact_bean->cases->getBeans();
	reset($relatedBeans);
	$case = current($relatedBeans);
	/* print"<pre>";print_r($relatedBeans);die; */
}


$header = '<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>Medical Record Summary</strong></span></td>
<td style="font-weight: bold; padding: 10px 5px 20px 145px; text-align: left;"><strong>                                             </strong></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $contact_bean->name .'</strong></span></td>
</tr>
<tr>
<td style="font-size: 11px;"><span style="font-size: 12px;">      Date</span></td>
<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 12px;">Description</span></td>
<td style="font-size: 12px; text-align: left;"> <span style="font-size: 12px;">Date Of Incident:</span> '.$case->date_of_incident_c .'</td>
</tr><tr ><td style="border-bottom:1px solid black"colspan="100%"></td></tr>
</tbody>
</table>';

$html = $header.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table style="height: 60px; width: 790px;"><tbody>';
if($contact_bean->load_relationship('mts_medical_treatment_summary_contacts')){
	$relatedBeans = $contact_bean->mts_medical_treatment_summary_contacts->getBeans();
	 
		foreach($relatedBeans as $id => $data){
			$data->document_name = explode('.', $data->document_name);	
			$html .='<tr style="height: 35px;">
			<td rowspan="3" style="padding:-90px 0px 0px 0px;   text-align: left; width: 270px; height: 35px;">'. $data->treatment_date .'<br>'.$data->medical_provider_organization .'<br>'.$data->medical_provider_person .'</td>
			<td style="  text-align: left; width: 400px; height: 40px;"><span style="font-size: 12px;"><strong>'.$data->document_name[0] .'</strong></span></td>
			</tr>
			<tr style="height: 35px;">
			
			<td style="   text-align: left; width: 400px; height: 40px;">'.$data->description .'</td>
			</tr>
			<tr style="height: 81px;">
			
			<td style="  text-align: left; width: 400px; height: 80px;">'. $data->treatment_description_summary .'</td>
			</tr><tr><td>&nbsp;</td></tr> <tr ><td style="border-bottom:1px solid black"colspan="100%"></td></tr>';			
		}   
}

$html .='</tbody></table>';
$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '12', '12', '-3', '-3','');	 
$pdf->AddPage();
$pdf->SetHTMLHeader($header);
$pdf->writeHtml($html);
ob_clean();
$pdf->Output("Medical Record Summary.pdf", 'I');