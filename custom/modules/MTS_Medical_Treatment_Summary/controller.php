<?php
class MTS_Medical_Treatment_SummaryController extends SugarController
{	
	function action_export_csv()
	{
		require_once('include/export_utils.php');
		global $locale;
		global $beanList;
		global $beanFiles;
		global $current_user;
		global $app_strings;
		global $app_list_strings;
		global $timedate;
		global $mod_strings;
		global $current_language;
		
		$cloumns = array(
			'startDate', 
			'title', 
			'attachment', 
			'medprovOrganization',
			'startTime',
			'endDate',
			'description',
			'color',
			'showAttachmentFirst',
		);
		$type = 'MTS_Medical_Treatment_Summary';
		$focus = new MTS_Medical_Treatment_Summary();
		$searchFields = array();
		$db = DBManagerFactory::getInstance();
		/* print"<pre>";print_r($_REQUEST);die; */
	    if(isset($_REQUEST['select_entire_list']) && $_REQUEST['select_entire_list'] == 0) {
			$records = $_REQUEST['mass'];
			$records = "'" . implode("','", $records) . "'";
			$where = "{$focus->table_name}.id in ($records)";
		 } elseif (isset($_REQUEST['record']) && !empty($_REQUEST['record'])) {
			 
			$where = "{$focus->table_name}.id = '{$_REQUEST['record']}'";
		 } elseif (isset($_REQUEST['all']) ) {
			$where = '';
		 } else {
			if(!empty($_REQUEST['current_query_by_page'])) {
				$ret_array = generateSearchWhere($type, $_REQUEST['current_query_by_page']);

				$where = $ret_array['where'];
				$searchFields = $ret_array['searchFields'];
			} else {
				$where = '';
			}
		}
		$order_by = "";
		// Export entire list was broken because the where clause already has "where" in it
		// and when the query is built, it has a "where" as well, so the query was ill-formed.
		// Eliminating the "where" here so that the query can be constructed correctly.
		$beginWhere = substr(trim($where), 0, 5);
		if ($beginWhere == "where")
			$where = substr(trim($where), 5, strlen($where));

		$query = $focus->create_export_query($order_by,$where);
	    /* echo 'ww '.$where;die; */
		$result = '';
		$result = $db->query($query, true, $app_strings['ERR_EXPORT_TYPE'].$type.": <BR>.".$query);
		
		while($row = $db->fetchByAssoc($result, false)) {
			$title = '';
			if($row['summary_title_list'] == 'OTHER'){
				$title = $row['document_name'];
			}else{
				$title = $GLOBALS['app_list_strings']['summary_title_list_dom'][$row['summary_title_list']];
			}
			$medprovOrganization = '';
			if(isset($row['account_id_c']) && !empty($row['account_id_c'])){
				$medprovOrganization = $row['medical_provider_organization'];				
			}else{
				$medprovOrganization = $row['medical_provider_person'];				
			}
			$treatment_date = date("m-d-Y", strtotime($row['treatment_date']));
			$data[$row['id']] = array(
				$treatment_date,
				$title, 
				$row['filename'], 
				$medprovOrganization,
				'',
				'',
				$row['treatment_description_summary'],
				$GLOBALS['app_list_strings']['summary_title_list_colors_dom'][$row['summary_title_list']],
				$row['show_file_first'],
			);
		}
		/* print"<pre>";print_r($data);die; */
		$delimiter = ",";
		$f = fopen('php://memory', 'w');
		$filename = "Medical Treatment Summary Report_". date('Y-m-d') . ".csv";
		fputcsv($f, $cloumns, $delimiter);
		foreach($data as $line_data){
			fputcsv($f, $line_data, $delimiter);
			
		}
		fseek($f, 0);
		ob_clean();
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');
		header("Pragma: no-cache");
		header("Expires: 0");
		fpassthru($f);
		exit;
	}	
	function action_export_excel()
	{
		require_once('include/export_utils.php');
		global $locale;
		global $beanList;
		global $beanFiles;
		global $current_user;
		global $app_strings;
		global $app_list_strings;
		global $timedate;
		global $mod_strings;
		global $current_language;
		
		$cloumns = array(
			'startDate', 
			'title', 
			'attachment', 
			'medprovOrganization',
			'startTime',
			'endDate',
			'description',
			'color',
			'showAttachmentFirst',
		);
		$type = 'MTS_Medical_Treatment_Summary';
		$focus = new MTS_Medical_Treatment_Summary();
		$searchFields = array();
		$db = DBManagerFactory::getInstance();
		/* print"<pre>";print_r($_REQUEST);die; */
	    if(isset($_REQUEST['select_entire_list']) && $_REQUEST['select_entire_list'] == 0) {
			$records = $_REQUEST['mass'];
			$records = "'" . implode("','", $records) . "'";
			$where = "{$focus->table_name}.id in ($records)";
		 } elseif (isset($_REQUEST['record']) && !empty($_REQUEST['record'])) {
			 
			$where = "{$focus->table_name}.id = '{$_REQUEST['record']}'";
		 } elseif (isset($_REQUEST['all']) ) {
			$where = '';
		 } else {
			if(!empty($_REQUEST['current_query_by_page'])) {
				$ret_array = generateSearchWhere($type, $_REQUEST['current_query_by_page']);

				$where = $ret_array['where'];
				$searchFields = $ret_array['searchFields'];
			} else {
				$where = '';
			}
		}
		$order_by = "";
		// Export entire list was broken because the where clause already has "where" in it
		// and when the query is built, it has a "where" as well, so the query was ill-formed.
		// Eliminating the "where" here so that the query can be constructed correctly.
		$beginWhere = substr(trim($where), 0, 5);
		if ($beginWhere == "where")
			$where = substr(trim($where), 5, strlen($where));

		$query = $focus->create_export_query($order_by,$where);
	    /* echo 'ww '.$where;die; */
		$result = '';
		$result = $db->query($query, true, $app_strings['ERR_EXPORT_TYPE'].$type.": <BR>.".$query);
		
		while($row = $db->fetchByAssoc($result, false)) {
			$title = '';
			if($row['summary_title_list'] == 'OTHER'){
				$title = $row['document_name'];
			}else{
				$title = $GLOBALS['app_list_strings']['summary_title_list_dom'][$row['summary_title_list']];
			}
			$medprovOrganization = '';
			if(isset($row['account_id_c']) && !empty($row['account_id_c'])){
				$medprovOrganization = $row['medical_provider_organization'];				
			}else{
				$medprovOrganization = $row['medical_provider_person'];				
			}
			$treatment_date = date("m-d-Y", strtotime($row['treatment_date']));
			$data[$row['id']] = array(
				$treatment_date,
				$title, 
				$row['filename'], 
				$medprovOrganization,
				'',
				'',
				$row['treatment_description_summary'],
				$GLOBALS['app_list_strings']['summary_title_list_colors_dom'][$row['summary_title_list']],
				$row['show_file_first'],
			);
		}
		$delimiter = ",";
		$f = fopen('php://memory', 'w');
		$filename = $type ."_". date('Y-m-d') . ".xls";
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		echo implode("\t", $cloumns) . "\n";
		foreach($data as $line_data){
			array_walk($line_data, array($this, 'cleanDataExcel'));
			echo implode("\t", $line_data) . "\n";
		}
		exit;
	}
	function cleanDataExcel(&$str){
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}
}
