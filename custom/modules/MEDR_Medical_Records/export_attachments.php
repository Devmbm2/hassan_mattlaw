<?php
	
	global $current_user, $sugar_version, $sugar_config, $beanFiles, $db;
	print"<pre>";print_r($_REQUEST);die;
	if(isset($_REQUEST['uid'])){
		$records = $_REQUEST['uid'];
		$$file_type = strtolower($_REQUEST['module']);
		$records = explode(',', $records);
		$records = "'" . implode("','", $records) . "'";
		$where = "id in ($records)";
		$sql = "  ";
		while($row = $this->bean->db->fetchByAssoc($result_elements)){
			
		}
	}
?>