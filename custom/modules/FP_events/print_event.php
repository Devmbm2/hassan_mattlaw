<?php
if (!isset($_REQUEST['uid']) || empty($_REQUEST['uid']) || !isset($_REQUEST['templateID']) || empty($_REQUEST['templateID'])) {
    die('Error retrieving record. This record may be deleted or you may not be authorized to view it.');
}

require_once('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
require_once('modules/AOS_PDF_Templates/templateParser.php');
require_once('modules/AOS_PDF_Templates/sendEmail.php');
require_once('modules/AOS_PDF_Templates/AOS_PDF_Templates.php');
require_once('custom/modules/Cases/views/view.detail.php');

global $mod_strings, $sugar_config;

$bean = BeanFactory::getBean($_REQUEST['module'], $_REQUEST['uid']);
if(!$bean){
    sugar_die("Invalid Record");
}

$task = $_REQUEST['task'];
$variableName = strtolower($bean->module_dir);


$template = new AOS_PDF_Templates();
$template->retrieve($_REQUEST['templateID']);
$object_arr = array();
$object_arr[$bean->module_dir] = $bean->id;

//backward compatibility
$object_arr['Accounts'] = $bean->billing_account_id;
$object_arr['Contacts'] = $bean->billing_contact_id;
$object_arr['Users'] = $bean->assigned_user_id;
$object_arr['Currencies'] = $bean->currency_id;

$search = array('/<script[^>]*?>.*?<\/script>/si',      // Strip out javascript
    '/<[\/\!]*?[^<>]*?>/si',        // Strip out HTML tags
    '/([\r\n])[\s]+/',          // Strip out white space
    '/&(quot|#34);/i',          // Replace HTML entities
    '/&(amp|#38);/i',
    '/&(lt|#60);/i',
    '/&(gt|#62);/i',
    '/&(nbsp|#160);/i',
    '/&(iexcl|#161);/i',
    '/<address[^>]*?>/si',
    '/&(apos|#0*39);/',
    '/&#(\d+);/'
);

$replace = array('',
    '',
    '\1',
    '"',
    '&',
    '<',
    '>',
    ' ',
    chr(161),
    '<br>',
    "'",
    'chr(%1)'
);

$header = preg_replace($search, $replace, $template->pdfheader);
$footer = preg_replace($search, $replace, $template->pdffooter);
$text = preg_replace($search, $replace, $template->description);
$text = str_replace("<p><pagebreak /></p>", "<pagebreak />", $text);
$text = preg_replace_callback('/\{DATE\s+(.*?)\}/',
    function ($matches) {
        return date($matches[1]);
    },
    $text);
$text = str_replace("\$aos_quotes", "\$" . $variableName, $text);
$text = str_replace("\$aos_invoices", "\$" . $variableName, $text);
$text = str_replace("\$total_amt", "\$" . $variableName . "_total_amt", $text);
$text = str_replace("\$discount_amount", "\$" . $variableName . "_discount_amount", $text);
$text = str_replace("\$subtotal_amount", "\$" . $variableName . "_subtotal_amount", $text);
$text = str_replace("\$tax_amount", "\$" . $variableName . "_tax_amount", $text);
$text = str_replace("\$shipping_amount", "\$" . $variableName . "_shipping_amount", $text);
$text = str_replace("\$total_amount", "\$" . $variableName . "_total_amount", $text);
$case_id = $bean->cases_fp_events_1cases_ida;
$attoneys = getRelatedDefandantData($case_id);
$hold_data = getRelatedHoldData($_REQUEST['uid']);
$related_case = BeanFactory::getBean('Cases', $case_id);
$client = BeanFactory::getBean('Contacts', $related_case->contact_id1_c);
$text = str_replace("\$client_phone", $client->phone_work, $text);
$text = str_replace("\$related_case_attorney", $attoneys, $text);
$text .= '<br />'.$hold_data;
$converted = templateParser::parse_template($text, $object_arr);
$header = templateParser::parse_template($header, $object_arr);
$footer = templateParser::parse_template($footer, $object_arr);
$printable = str_replace("\n", "<br />", $converted);
// echo $printable;die;
    $file_name = $mod_strings['LBL_PDF_NAME'] . "_" . str_replace(" ", "_", $bean->name) . ".pdf";

    ob_clean();
    try {
        $pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', $template->margin_left, $template->margin_right, $template->margin_top, $template->margin_bottom, $template->margin_header, $template->margin_footer);
        $pdf->SetAutoFont();
        $pdf->SetHTMLHeader($header);
        $pdf->SetHTMLFooter($footer);
        $pdf->WriteHTML($printable);
        $pdf->Output($file_name, "D");
    } catch (mPDF_exception $e) {
        echo $e;
    }

function getRelatedDefandantData($case_id){
	$fieldMappingDefandantUmDefandant['def_defendants_cases'] = array('attorney_id_1' => 'contact_id4_c', 
								  'attorney_name_1' => 'defense_attorney_c', 
								  'attorney_phone_1' => 'defense_attorney_phone_c',
								  'attorney_id_2' => 'contact_id5_c', 
								  'attorney_name_2' => 'defense_attorney_2_c', 
								  'attorney_phone_2' => 'defense_attorney_2_phone_c'
								);
	$fieldMappingDefandantUmDefandant['def_client_insurance_cases_1'] = array('attorney_id_1' => 'contact_id1', 
								  'attorney_name_1' => 'defense_attorney_c', 
								  'attorney_phone_1' => 'defense_attorney_phone_c',
								  'attorney_id_2' => 'contact_id2', 
								  'attorney_name_2' => 'defense_attorney_2_c', 
								  'attorney_phone_2' => 'defense_attorney_2_phone_c'
								);
	$html = "";
	$html .= '<table id = "defandant" style="font-size:35px;width:799px;font-family:Arial;text-align:center;height:134px;" border=1>
			  <tr>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Defendant</td>		  
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Attorney 1</td>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Attorney 1 Phone</td>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Attorney 2</td>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Attorney 2 Phone</td>';		  
	$html  .= '</tr>';
	$relationships = array('def_defendants_cases', 'def_client_insurance_cases_1');
	foreach($relationships as $relationship){
		$attorney_id_1 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_id_1'];
		$attorney_name_1 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_name_1'];
		$attorney_phone_1 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_phone_1'];
		$attorney_id_2 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_id_2'];
		$attorney_name_2 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_name_2'];
		$attorney_phone_2 = $fieldMappingDefandantUmDefandant[$relationship]['attorney_phone_2'];
		$case_bean = BeanFactory::getBean('Cases', $case_id);
		if($case_bean->load_relationship($relationship)){
			$relatedAttorney = $case_bean->$relationship->getBeans();
			if(!empty($relatedAttorney)){
				$attorny = array();
				foreach($relatedAttorney as $id => $data){
					$html .= '<tr>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;"><a href="index.php?module='. $data->module_dir .'&action=DetailView&record='.$data->id .'" target="_blank">'. $data->name .'</a></td>  
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;"><a href="index.php?module=Contacts&action=DetailView&record='.$data->$attorney_id_1.'" target="_blank">'.$data->$attorney_name_1.'</a></td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$data->$attorney_phone_1.'</td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;"><a href="index.php?module=Contacts&action=DetailView&record='.$data->$attorney_id_2.'" target="_blank">'.$data->$attorney_name_2.'</a></td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$data->$attorney_phone_2.'</td>';	  
					$html  .= '</tr>';
				}
			}
		}
	}	
	$html .= "</table>";
	return $html;
}
function getRelatedHoldData($fpevent_id)
{
$count = 0;
	global $db;
	$html = "";
	$html .= '<h2>Alternative Dates For Events</h2>';
	$html .= '<table id = "alternative-dates" style="font-size:35px;width:799px;font-family:Arial;text-align:center;height:134px;" border=1>
			  <tr>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Sr. No.</td>		  
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Date Start</td>
			  <td style = "font-weight:bold;background-color:#b0c4de;padding:2px 6px;border-style:solid;border-width:.5px;vertical-align:top;text-align:left;width:50%;">Date End</td>';		  
	$html  .= '</tr>';
	$sql = "SELECT * FROM fp_events WHERE related_event_id = '{$fpevent_id}' AND deleted = 0";
		$result = $db->query($sql);
	$sql2 = "SELECT * FROM fp_events WHERE id = '{$fpevent_id}'  AND deleted = 0";
		$result2 = $db->query($sql2);
		if($result2->num_rows>0)
		{
		$row2 = $db->fetchByAssoc($result2); 
			$FP_events = BeanFactory::getBean('FP_events', $row2['id']);
			$html .= '<tr style = "background-color:yellow;">
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.++$count.'</td>  
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_start.'</td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_end.'</td>';	  
					$html  .= '</tr>';
		}	
		if($result->num_rows>0)
		{
		while ($row = $db->fetchByAssoc($result)) {
			++$count;
			$FP_events = BeanFactory::getBean('FP_events', $row['id']);
			$html .= '<tr style = "background-color:yellow;">
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$count.'</td>  
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_start.'</td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_end.'</td>';	  
					$html  .= '</tr>';
		}
	}
	else
	{
		$sql2 = "SELECT related_event_id FROM fp_events WHERE id = '{$fpevent_id}' AND deleted = 0";
		$result2 = $db->query($sql2);
		$row2 = $db->fetchByAssoc($result2);
		$related_id = $row2["related_event_id"];
		// echo $related_id;die();
		if(!empty($related_id))
		{
		$sql3 = "SELECT * FROM fp_events WHERE related_event_id = '{$related_id}' AND deleted = 0";
		$result3 = $db->query($sql3);
		$sql4 = "SELECT * FROM fp_events WHERE id = '{$related_id}'  AND deleted = 0";
		$result4 = $db->query($sql4);
		if($result3->num_rows>0)
		{
		// print"<pre>";print_r($result);die();
		while ($row3 = $db->fetchByAssoc($result3)) {
			++$count;
			$FP_events = BeanFactory::getBean('FP_events', $row3['id']);
			if($FP_events->id == $fpevent_id)
			{
				
			}
			else
			{
			$html .= '<tr style = "background-color:yellow;">
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$count.'</td>  
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_start.'</td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_end.'</td>';	  
					$html  .= '</tr>';

			}
		}
	}
		$row4 = $db->fetchByAssoc($result4); 
		$FP_events = BeanFactory::getBean('FP_events', $row4['id']);
		$html .= '<tr style = "background-color:yellow;">
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.++$count.'</td>  
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_start.'</td>
					<td style ="padding:2px 6px;border-style:solid;border-width:.5px;width:50%;vertical-align:top;text-align:left;">'.$FP_events->date_end.'</td>';	  
					$html  .= '</tr>';
	}
}	
	$html .= "</table>";	
	 return $html;
}