<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = 'dfebd691-fe9f-253f-06c4-5af3473d20bc'; */
$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['record']);
/* $contact_bean = BeanFactory::getBean('Contacts', $record_id); */
if($contact_bean->load_relationship('medb_medical_bills_contacts')){
	$relatedBeans = $contact_bean->medb_medical_bills_contacts->getBeans();
	reset($relatedBeans);
	$medb_medical_bills_contacts = current($relatedBeans);
	/* print"<pre>";print_r($relatedBeans);die; */
}


$header = '<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>Medical Bill Summary - Total Charges</strong></span></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $contact_bean->name .'</strong></span></td>
</tr>

</tbody>
</table>';

$stream_html = $header;
$stream_html .='<script type="text/javascript" src="custom/modules/Contacts/js/detail.js"></script>';
$stream_html .= '<div><label for="medical_providers" >List Of Medical Providers</label><br>';
$stream_html .='<select style="width: 10%;" name="medical_providers_bill" id="medical_providers_bill" multiple >';

		
		
		if($contact_bean->load_relationship('medb_medical_bills_contacts')){
			$relatedBeans = $contact_bean->medb_medical_bills_contacts->getBeans();
			$related_medical_providers = array();
			foreach($relatedBeans as $id => $data){
				if(empty($data->id))continue;
				$related_medical_providers[$data->id] = $data->name;	
			}
			asort($related_medical_providers);
			foreach($related_medical_providers as $id => $option){
				$stream_html .='<option  value='. $id .'>'. $option .'</option>';		
			}
		}
	$stream_html .='</select><br><br><br><br><br><br><br>';
	$stream_html .='<script type="text/javascript" src="custom/modules/Contacts/js/detail.js"></script>';
	$stream_html .='<input type="button" id = "generate_report" value="Generate Report" onclick="SendMedicalProvidor_related_bills_report(\''.$_REQUEST['record'].'\');">';
	$stream_html .='</div>';
echo $stream_html;die;
