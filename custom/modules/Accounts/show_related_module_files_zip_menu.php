<?php
$case_bean = BeanFactory::getBean('Accounts', $_REQUEST['record']);

$case_related_modules = array(
			'' => '',
			'Activities' => 'Activities',
			'Bugs' => 'Bugs',
			'Campaigns' => 'campaigns',
			'Cases' => 'Cases',
			'Contracts' => 'Contracts',
			'Documents' => 'Documents',
			'Notes' => 'Notes',
			'Invoices' => 'Invoices',
			'Insurance' => 'Insurance',
			'Opportunities' => 'Opportunities',
			'Project' => 'Project',
			'Quotes' => 'Quotes',
			'Running Bills/Liens' => 'Running Bills/Liens',
			'Security Groups' => 'Security Groups',
			'Soft Documents' => 'Soft Doucments',
			'Emails' => 'Emails',
						);
$case_related_modules_type = array(
			'' => '',
			'docx' => '.docx',
			'pdf' => '.pdf',
			'png' => '.png',
			'jpg' => '.jpg',
			'txt' => '.txt',
			'mp3' => '.mp3',
			'mp4' => '.mp4',
						);
$header = '
<table style="height: 60px; width: 800px; border-spacing:-2;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>List of Related Modules Files to download as ZIP</strong></span></td>
<td style="font-weight: bold; text-align: left;"><span style="font-size: 12px;"><strong>'. $case_bean->name .'</strong></span></td>
</tr>

</tbody>
</table>';

$stream_html = $header;
$stream_html .='<select style="height:50%;width: 60%;" name="list_of_case_related_modules" id="list_of_case_related_modules" multiple >';

foreach($case_related_modules as $link_name => $subpanel_name){
	$stream_html .='<option value='. $link_name .'>'. $subpanel_name .'</option>';		
}
$stream_html .='</select><br>';
$stream_html .='<select style="height:50%;width: 60%;" name="list_of_case_related_modules_type" id="list_of_case_related_modules_types" multiple >';

foreach($case_related_modules_type as $link_type_name => $type_name){
	$stream_html .='<option value='. $link_type_name .' selected>'. $type_name .'</option>';	
}
$stream_html .='</select><br>';
// $stream_html .='<select style="height:50%;width: 60%;display:none;" name="list_of_case_related_modules_type_files" id="list_of_case_related_modules_type_files" multiple >';

// $stream_html .='</select><br>';
	// $stream_html .='<input type="button" id = "generate_report" value="Download Zip" onclick="related_module_files_zip_download(\''.$_REQUEST['record'].'\');">';
	$stream_html .='<input type="button" id = "show_files" value="Preview Files">';
echo $stream_html;die;
