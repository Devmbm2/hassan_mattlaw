<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
/* $record_id = 'dfebd691-fe9f-253f-06c4-5af3473d20bc'; */
$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['record']);
/* $contact_bean = BeanFactory::getBean('Contacts', $record_id); */
if($contact_bean->load_relationship('cases')){
	$relatedBeans = $contact_bean->cases->getBeans();
	reset($relatedBeans);
	$case = current($relatedBeans);
	/* print"<pre>";print_r($relatedBeans);die; */
}

global $log;
$header = '<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>Medical Record Summary</strong></span></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $contact_bean->name .'</strong></span></td>
</tr>

</tbody>
</table>';

$stream_html = $header;
$stream_html .='<script type="text/javascript" src="custom/modules/Contacts/js/detail.js"></script>';
$stream_html .= '<div><label style ="color:red;" >Click On Generate Report button if you want to Print all the Medical Summary Records. No need to Select the Medical Providers OR Medical Provider Organizations.</label><br><br>';
$stream_html .= '<div><label for="medical_providers" >List Of Medical Providers</label><br>';
$stream_html .='<select style="height:50%;width: 60%;" name="medical_providers" id="medical_providers" multiple >';
	$log->fatal('mts_medical_treatment_summary_contacts');
	if($contact_bean->load_relationship('mts_medical_treatment_summary_contacts')){
		$relatedBeans = $contact_bean->mts_medical_treatment_summary_contacts->getBeans(array('order_by' => 'contacts.name ASC'));
		$related_medical_providers = array();
		foreach($relatedBeans as $id => $data){
			if(empty($data->contact_id_c))continue;
			$related_medical_providers[$data->contact_id_c] = $data->medical_provider_person;	
		}
		asort($related_medical_providers);
		foreach($related_medical_providers as $id => $option){
			$stream_html .='<option value='. $id .'>'. $option .'</option>';		
		}
	}
	$stream_html .='</select><br>';
	$stream_html .='<script type="text/javascript" src="custom/modules/Contacts/js/detail.js"></script>';
	$stream_html .= '<div><label for="medical_providers" >List Of Medical Provider Organizations</label><br>';
	$stream_html .='<select style="height:50%;width: 60%;" name="medical_provider_organizations" id="medical_provider_organizations" multiple >';

	if($contact_bean->load_relationship('mts_medical_treatment_summary_contacts')){
		$relatedBeans = $contact_bean->mts_medical_treatment_summary_contacts->getBeans();
		$related_medical_providers_organization = array();
		foreach($relatedBeans as $id => $data){
			if(empty($data->account_id_c))continue;
			$related_medical_providers_organization[$data->account_id_c] = $data->medical_provider_organization;		
		}
		asort($related_medical_providers_organization);
		/* print"<pre>";print_r($related_medical_providers_organization); */
		foreach($related_medical_providers_organization as  $id =>  $option){
			$stream_html .='<option value='. $id .'>'. $option .'</option>';		
		}
	}
	$stream_html .='</select><br><br>';
	$stream_html .='<label for="start_date" >Start Date</label><br>';
	$stream_html .='<input type="date" id = "start_date" name = "start_date" value="" required><br><br>';
	$stream_html .='<label for="end_date" >End Date</label><br>';
	$stream_html .='<input type="date" id = "end_date" name = "end_date" value="" required><br><br>';
	$stream_html .='</select><br><br>';
	$stream_html .='<input type="button" id = "generate_report" value="Generate Report" onclick="SendMedicalProvidor(\''.$_REQUEST['record'].'\');">';
	$stream_html .='</div>';

echo $stream_html;die;