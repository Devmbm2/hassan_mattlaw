<?php

if(isset($_POST['file'])){
	global $db;
	$file = $_POST['file'];
	if(file_exists($file)){
		unlink($file);
		echo $file;
	}
	echo $file;
}
?>
