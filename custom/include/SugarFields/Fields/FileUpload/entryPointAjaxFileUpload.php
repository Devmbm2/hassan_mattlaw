<?php
	global $db;
	$target_dir = "upload/attachments";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$GLOBALS['log']->fatal('$_FILES');
	$GLOBALS['log']->fatal(print_r($_FILES, true));
	$GLOBALS['log']->fatal('$_FILES1');
	$GLOBALS['log']->fatal(print_r($_FILES['files']['type'][0], true));
	$file_id = create_guid();
	$fname = $_FILES['files']['name'][0];
	$target = $target_dir. '/' . $file_id;
	$file_size = $_FILES["files"]["size"][0];
	$type = $_FILES["files"]["type"][0];
	$module_id = $_REQUEST['record'];
	$module = $_REQUEST['module'];
	$db->query($notes,true);	
	move_uploaded_file($_FILES["files"]["tmp_name"][0], $target);
	echo json_encode(array('file_id' => $file_id, 'file_name' => $fname ,'file_type' => $type));
