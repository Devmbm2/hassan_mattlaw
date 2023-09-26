<?php
$case_bean = BeanFactory::getBean('Contacts', $_REQUEST['record']);

$case_related_modules = array(
							'' => '',
							'Liens' => 'Liens',
							'Hard_Documents_contacts' => 'Hard Documents',
							'Med_Summary' => 'Med Summary',
							'Medical_Records' => 'Medical Records',
							'Negotiations_contacts' => 'Negotiations',
							'Radiology' => 'Radiology',
							/* 'Running_Bills_Liens' => 'Running Bills/Liens', */
							'Received_Bills_Liens' => 'Received Bills/Liens',
							'Running_Bills_Liens_Medical_Bills' => 'Running Bills/Liens Medical Bills',
							'Soft_Documents_contacts' => 'Soft Documents',
							'Transcript_Statement_contacts' => 'Transcript Statement',
						);
$header = '<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>List of Related Modules Files to download as ZIP</strong></span></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong> '. $case_bean->name .'</strong></span></td>
</tr>

</tbody>
</table>';

$stream_html = $header;
$stream_html .='<select style="height:50%;width: 60%;" name="list_of_case_related_modules" id="list_of_case_related_modules" multiple >';

foreach($case_related_modules as $link_name => $subpanel_name){
	$stream_html .='<option value='. $link_name .'>'. $subpanel_name .'</option>';		
}
$stream_html .='</select><br>';

	$stream_html .='<input type="button" id = "generate_report" value="Download Zip" onclick="related_module_files_zip_download(\''.$_REQUEST['record'].'\');">';

echo $stream_html;die;