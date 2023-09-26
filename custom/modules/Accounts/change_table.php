<?php
global $db;

if(isset($_REQUEST['table_name']) && !empty($_REQUEST['table_name'])){
	$table = 'accounts_'.$_REQUEST['table_name'];
	$result = $db->query("SHOW TABLES LIKE '".$table."'");
	if($_REQUEST['table_name'] == 'orignal'){
		if($result->num_rows == 1) {
			$db->query("RENAME TABLE accounts TO accounts_merged", true);
			$db->query("RENAME TABLE accounts_orignal TO accounts", true);
		}
			echo "Changed To Organiztions Orignal Data...";die;
	}else{
		if($result->num_rows == 1) {
			$db->query("RENAME TABLE accounts TO accounts_orignal", true);
			$db->query("RENAME TABLE accounts_merged TO accounts", true);
		}
			echo "Changed To Organiztions Merged Data...";die;
	}
}
	