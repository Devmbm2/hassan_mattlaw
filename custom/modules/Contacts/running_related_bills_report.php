<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = 'b96c5646-8c3f-8056-d1c4-5b3a022aace9'; */
global $db;

$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['record_id']);
/* echo $contact_bean->name;die; */
if($contact_bean->load_relationship('cases')){
	$relatedBeans = $contact_bean->cases->getBeans();
	reset($relatedBeans);
	$case = current($relatedBeans);
	/* print"<pre>";print_r($relatedBeans);die; */
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

<p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;text-align: center;">' . $contact_bean->name . '</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size: 14px;text-align: center;padding-top: -15px;"><strong>Medical Bill Summary - Total Charges</strong></p>
<table style="height: 60px; width: 400px;margin-left:auto;margin-right:auto;">
<tr>
<td>
<p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;"><strong>Medical Provider</strong></p>
</td>
<td align="right">
<p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;margin-left:70px;"><strong>Total Charges</strong></p>
</td>
</tr>
</table>
';

$html = $header;
$html .= '<table style="height: 60px; width: 400px;margin-left:auto;margin-right:auto;"><tr><td style=" padding:0px 0px 0px 0px;border-bottom:4px solid black" colspan="2"></td></tr>';
if($contact_bean->load_relationship('medb_medical_bills_contacts')){
	$where_medical_provider = '';
	$where = '';
	if(isset($_REQUEST['medical_providers_bill']) && !empty($_REQUEST['medical_providers_bill']) && $_REQUEST['medical_providers_bill'] != null){
		$_REQUEST['medical_providers_bill'] = explode(',',$_REQUEST['medical_providers_bill']);
		
		$where_medical_provider = "medb_medical_bills.id IN ('".implode("','", $_REQUEST['medical_providers_bill'])."')";		
	}
	$total =0;
	/* print"<pre>";print_r($_REQUEST['medical_providers_bill']); */
	$relatedBeans = $contact_bean->medb_medical_bills_contacts->getBeans();
	foreach($_REQUEST['medical_providers_bill'] as $no => $id){
		$data = BeanFactory::getBean('MEDB_Medical_Bills', $id);
		/* echo $data->id;echo '<br>'; */
		/* if(in_array($data->id, $_REQUEST['medical_providers_bill'])){
			continue;
		} */
		$total +=$data->total_charges;
		$html .='<tr>
					<td><p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;">'.
						$data->name
					.'</p></td>
					<td><p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;"> $'.
						number_format($data->total_charges, 2)
					.'</p></td>
				</tr>
				<tr><td style=" padding:0px 0px 0px 0px;border-bottom:1px solid black" colspan="2"></td></tr>
				';
	}
	$html .='<tr>
					<td align="right">
					<p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;"><strong>Total</strong></p>
					</td>
					<td><p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;"> $'.
						number_format($total, 2)
					.'</p></td>
			</tr>';
}
$html .='</table>';
/* $pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '0', '0', '-3', '-3','0'); */
$pdf = new mPDF('en', 'A4', '22', 'DejaVuSansCondensed', 10, 10, 10, 16, 9, 9);
$pdf->AddPage();
/* $pdf->SetHTMLHeader($header); */
$pdf->WriteHTML($html);

$pdf->Output();
ob_clean();
$pdf->Output("Medical Bill Summary - Total Charges.pdf", 'I');