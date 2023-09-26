<?php
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
$template -> retrieve('254dde6c-51c7-71a9-5fcc-5e56254689da');

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

        $related_beans = $focus -> get_linked_beans($relationship_field_name, $relationship_bean_name);
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

