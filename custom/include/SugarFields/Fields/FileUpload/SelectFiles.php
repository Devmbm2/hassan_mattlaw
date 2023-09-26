<?php
	global $db;
	$path_files=array();
	$get_elements="SELECT id,path FROM module_related_files where record_id='{$_POST['record']}' AND deleted=0";
	$result_elements = $db->query($get_elements);
	while($row_elements = $db->fetchByAssoc($result_elements)){
		$path_files[$row_elements['id']]=$row_elements['path'];
	}
	print_r(json_encode($path_files));die;