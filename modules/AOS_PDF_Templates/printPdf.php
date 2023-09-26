<?php
/**
 * Products, Quotations & Invoices modules.
 * Extensions to SugarCRM
 * @package Advanced OpenSales for SugarCRM
 * @subpackage Products
 * @copyright SalesAgility Ltd http://www.salesagility.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author Salesagility Ltd <support@salesagility.com>
 */

//ini_set('display_errors', '1');

require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
require_once ('modules/AOS_PDF_Templates/templateParser.php');
require_once ('modules/AOS_PDF_Templates/AOS_PDF_Templates.php');

global $sugar_config, $beanList;

$module_type = $_REQUEST['module'];
$module_type_create = rtrim($module_type, 's');

$module = new $beanList[$_REQUEST['module']]();

$recordIds = array();

if (isset($_REQUEST['current_post']) && $_REQUEST['current_post'] != '') {
    $order_by = '';
    require_once ('include/MassUpdate.php');
    $mass = new MassUpdate();
    $mass -> generateSearchWhere($_REQUEST['module'], $_REQUEST['current_post']);
    $ret_array = create_export_query_relate_link_patch($_REQUEST['module'], $mass -> searchFields, $mass -> where_clauses);
    $query = $module -> create_export_query($order_by, $ret_array['where'], $ret_array['join']);
    $result = $GLOBALS['db'] -> query($query, true);
    $uids = array();
    while ($val = $GLOBALS['db'] -> fetchByAssoc($result, false)) {
        array_push($recordIds, $val['id']);
    }
} else {
    $recordIds = explode(',', $_REQUEST['uid']);
}

$template = new AOS_PDF_Templates();
$template -> retrieve($_REQUEST['templateID']);

//simbanic
$orientation='';
$format='A4';
if($template->landscap_c == '1' || $template->landscap_c == 'on'){
	$orientation = 'L';
	$format='A4-L';
}

		$pdf = new mPDF('en', $format, '', 'DejaVuSansCondensed', $template -> margin_left, $template -> margin_right, $template -> margin_top, $template -> margin_bottom, $template -> margin_header, $template -> margin_footer,$orientation);

foreach ($recordIds as $recordId) {
    $module -> retrieve($recordId);
		$pdf_history = new mPDF('en', $format, '', 'DejaVuSansCondensed', $template -> margin_left, $template -> margin_right, $template -> margin_top, $template -> margin_bottom, $template -> margin_header, $template -> margin_footer,$orientation);

    $object_arr = array();
    $object_arr[$module_type] = $module -> id;

    if ($module_type === 'Contacts') {
        $object_arr['Accounts'] = $module -> account_id;
    }

    $search = array(
        '@<script[^>]*?>.*?</script>@si', // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
        '@([\r\n])[\s]+@', // Strip out white space
        '@&(quot|#34);@i', // Replace HTML entities
        '@&(amp|#38);@i',
        '@&(lt|#60);@i',
        '@&(gt|#62);@i',
        '@&(nbsp|#160);@i',
        '@&(iexcl|#161);@i',
        '@<address[^>]*?>@si'
    );

    $replace = array(
        '',
        '',
        '\1',
        '"',
        '&',
        '<',
        '>',
        ' ',
        chr(161),
        '<br>'
    );
	//echo $text;die;
    $text = preg_replace($search, $replace, $template -> description);
    $text = preg_replace_callback('/\{DATE\s+(.*?)\}/', function($matches) {
        return date($matches[1]);
    }, $text);
    $header = preg_replace($search, $replace, $template -> pdfheader);
    $footer = preg_replace($search, $replace, $template -> pdffooter);
	if($_REQUEST['module']=='r_Permit'){
		global $db;
			$r_permit_record = BeanFactory::getBean('r_Permit', $module->id);
			$fields = array(
				1=>'flammable_hydrocarbon_liquid_c',
				2=>'ignition_sources_c',
				3=>'confined_space_entry_c',
				4=>'low_temperature_process_c',
				5=>'release_of_pressure_c',
				6=>'inert_atmosphere_c',
				7=>'hazardous_substances_c',
				8=>'high_voltage_hv_electricit_c',
				9=>'low_voltage_lv_electricity_c',
				10=>'rotating_machinery_c',
				11=>'ionising_radiation_c',
				12=>'excessive_temperature_c',
				13=>'working_at_heights_c',
				14=>'dropped_objects_c',
				15=>'excavation_or_penetration_c',
				16=>'other_c',
			);
			$hazard_control_condition_comment='';

			foreach($fields as $key=>$field){
				$comment = $field.'_comment';
				if(!empty($r_permit_record->$comment)){
					$hazard_control_condition_comment .= '<p style="font-family: \'Gill Sans MT\',serif; font-size: 11px; color: #2b2a29; font-weight: normal; font-style: normal; text-decoration: none;">'.$key.'. '.$r_permit_record->$comment.'</p><hr>';
				}
			}
			$text = str_ireplace('hazard_control_condition_comment' , $hazard_control_condition_comment ,$text);
			foreach($fields as $key=>$field){

				if($r_permit_record->$field=='Yes'){
					$text = str_ireplace(''.$field.'_checkbox' , '<input id="'.$field.'" title="" type="checkbox" name="'.$field.'" value="1" disabled="disabled" checked="checked"/>',$text);
				}else{
					$text = str_ireplace(''.$field.'_checkbox' , '<input id="'.$field.'" title="" type="checkbox" name="'.$field.'" value="0" disabled="disabled" />',$text);
				}
			}

		$hazards_fields = array(
			'hold_points_c'=>'hold_points_required_c',
			'pre_gas_c'=>'pre_gas_c',
			'additional_con_c'=>'additional_continuous_gas_mo_c',
			'recording_of_gas_c'=>'recording_of_gas_c',
			'competent_fire_watcher_c'=>'competent_fire_c',
			'vehicle_equip_spotter_c'=>'vehicle_equip_spotter_c',
			'inhibiting_a_critical_c'=>'inhibiting_a_critical_c',
			'contact_control_room_c'=>'contact_control_c',
			'psa_approval_c'=>'psa_approval_required_c',
			'equip_drained_depressured_c'=>'equip_drained_c',
			'clp_number_c'=>'clp_numb_c',
			'isolation_lock_number'=>'isolation_lock_num_c',
			'pa_lock_num_c'=>'pa_lock_number_c',
			'job_lock_numb_c'=>'job_lock_number_c',
			);
			foreach($hazards_fields as $key=>$field){
				$radio_button = $field.'_custom_radio_comment';
					$IA = '';
					$AO = '';
					$ph = '';
				if($r_permit_record->$radio_button=='PH'){
					$ph = 'PH';
				}
				if($r_permit_record->$radio_button=='AO'){
					$AO = 'AO';
				}
				if($r_permit_record->$radio_button=='IA'){
					$IA = 'IA';
				}
				$comments = $field.'_comment';
				$text = str_ireplace('ph_'.$key.'' , $ph,$text);
				$text = str_ireplace('ao_'.$key.'' , $AO,$text);
				$text = str_ireplace('ia_'.$key.'' , $IA,$text);
				$text = str_ireplace('comment_'.$key.'' , $r_permit_record->$comments,$text);
			}
				$text = str_ireplace('prior_to_commencing_work_c_comment' , $r_permit_record->prior_to_commencing_work_c_comment,$text);
	}
    $text = templateParser::parse_template($text, $object_arr);

    $converted = print_relationship_records($text, $module);

    $header = templateParser::parse_template($header, $object_arr);
    $footer = templateParser::parse_template($footer, $object_arr);

    $printable = str_replace("\n", "<br />", $converted);
	if($_REQUEST['module']=='r_Permit'){

		$printable = str_replace("\$copy", "Permit Authority - Copy 1", $converted).'<p><pagebreak /></p>';
		$printable1 = str_replace("\$copy", "Area Operator - Copy 2", $converted).'<p><pagebreak /></p>';
		$printable2 = str_replace("\$copy", "Permit Holder - Copy 3", $converted);
	}
	if($_REQUEST['client_cost_total']=='true'){
		global $db;
		$case_id = $_REQUEST['uid'];
		$total=0;
		$result = $db->query("SELECT cost.total_amount FROM cost_client_cost as cost 
							  INNER JOIN cost_client_cost_cases_c as rel
							  ON (cost.id=rel.cost_client_cost_casescost_client_cost_idb AND rel.deleted=0 AND rel.cost_client_cost_casescases_ida='{$case_id}')");	
		while ($row = $db->fetchByAssoc($result)) {
			$total += (float)$row['total_amount'];
		}
		$printable = str_replace("\$total_amt", $total, $converted);
	}
    $file_name = str_replace(" ", "_", $template -> name) . ".pdf";

    ob_clean();
    try {


        $fp = fopen($sugar_config['upload_dir'] . 'nfile.pdf', 'wb');
        fclose($fp);

        $pdf_history -> setAutoFont();
        $pdf_history -> SetHTMLHeader($header);
        $pdf_history -> SetHTMLFooter($footer);
        $pdf_history -> writeHTML($printable);
		if($_REQUEST['module']=='r_Wellsite_Handover'){
			$pdf_history->SetImportUse();
			$pagecount = $pdf_history->SetSourceFile('custom/modules/r_Permit/page2.pdf');
			$tplId = $pdf_history->ImportPage($pagecount);

			$pdf_history->UseTemplate($tplId);
		}
        $pdf_history -> Output($sugar_config['upload_dir'] . 'nfile.pdf', 'F');
        $pdf -> AddPage();
        $pdf -> setAutoFont();
        $pdf -> SetHTMLHeader($header);
        $pdf -> SetHTMLFooter($footer);
        $pdf -> writeHTML($printable);
	if($_REQUEST['module']=='r_Permit'){
        $pdf -> setAutoFont();
        $pdf -> SetHTMLHeader($header);
        $pdf -> SetHTMLFooter($footer);
        $pdf -> writeHTML($printable1);
        $pdf -> setAutoFont();
        $pdf -> SetHTMLHeader($header);
        $pdf -> SetHTMLFooter($footer);
        $pdf -> writeHTML($printable2);
	}
        rename($sugar_config['upload_dir'] . 'nfile.pdf', $sugar_config['upload_dir'] . $note -> id);

    } catch(mPDF_exception $e) {
        echo $e;
    }
}


	$pdf -> Output($file_name, "I");	

function print_relationship_records($string, $focus) {

    //START
    //Get Relationships of modules.
    $linked_fields = $focus -> get_linked_fields();

    foreach ($linked_fields as $linked_field_defs) {

        if (isset($linked_field_defs['relationship'])) {
            $relationship_name = $linked_field_defs['relationship'];
            $relationship_bean_name = $linked_field_defs['bean_name'];
            $relationship_field_name = $linked_field_defs['name'];
        } else {
            continue;
        }
		$order_by = '';
		if($relationship_field_name == 'cost_client_cost_cases'){
			$order_by = 'date_entered ASC';			
		}
        $related_beans = $focus -> get_linked_beans($relationship_field_name, $relationship_bean_name, $order_by);
        unset($bean -> $relationship_name);

        if (empty($related_beans) && !empty($relationship_bean_name)) {
          if (class_exists($relationship_bean_name))
            $related_beans[0] = new $relationship_bean_name();

            foreach($related_beans[0]->field_defs as $field_name=>$field_def){
				$related_beans[0]->$field_name = "";
			}

        }

        $parts = get_line_for_relate_bean($string, $related_beans[0], $relationship_name);

        if ($parts === FALSE) {
            continue;
        }

        $linePart = $parts['line_part'];
        $string = $parts['parts']['0'];

        foreach ($related_beans as $bean) {

            $string .= templateParser::parse_template_bean($linePart, $relationship_name, $bean);
        }

        $string .= $parts['parts']['1'];

    }
    //END

    return $string;
}

function get_line_for_relate_bean($text, $bean, $relationship_name, $element = 'tr') {

    $firstValue = '';
    $firstNum = 0;

    $lastValue = '';
    $lastNum = 0;

    $startElement = '<' . $element;
    $endElement = '</' . $element . '>';

    //Find first and last valid line values

    foreach ($bean->field_defs as $name => $arr) {
        if (!((isset($arr['dbType']) && strtolower($arr['dbType']) == 'id') || $arr['type'] == 'id' || $arr['type'] == 'link')) {

            $curNum = strpos($text, '$' . $relationship_name . "_" . $name);

            if ($curNum) {
                if ($curNum < $firstNum || $firstNum == 0) {
                    $firstValue = '$' . $relationship_name . "_" . $name;
                    $firstNum = $curNum;

                }
                if ($curNum > $lastNum) {
                    $lastValue = '$' . $relationship_name . "_" . $name;
                    $lastNum = $curNum;

                }
            }
        }
    }

    if ($firstValue !== '' && $lastValue !== '') {

        //Converting Text
        $tparts = explode($firstValue, $text);

        $temp = $tparts[0];

        //check if there is only one line item
        if ($firstNum == $lastNum) {
            $linePart = $firstValue;
        } else {
            $tparts = explode($lastValue, $tparts[1]);

            $linePart = $firstValue . $tparts[0] . $lastValue;
        }

        $tcount = strrpos($temp, $startElement);
        $lsValue = substr($temp, $tcount);
        $tcount = strpos($lsValue, ">") + 1;
        $lsValue = substr($lsValue, 0, $tcount);

        //Read line end values
        $tcount = strpos($tparts[1], $endElement) + strlen($endElement);
        $leValue = substr($tparts[1], 0, $tcount);
        $tdTemp = explode($lsValue, $temp);

        $linePart = $lsValue . $tdTemp[count($tdTemp) - 1] . $linePart . $leValue;
        $parts = explode($linePart, $text);

        return array(
            'line_part' => $linePart,
            'parts' => $parts,
        );

    } else
        return FALSE;

}
?>
