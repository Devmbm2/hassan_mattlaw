<?php
global $db;

if(isset($_REQUEST['table_name']) && !empty($_REQUEST['table_name'])){
	$table = 'medp_medical_providers_'.$_REQUEST['table_name'];
	$result = $db->query("SHOW TABLES LIKE '".$table."'");
	if($_REQUEST['table_name'] == 'orignal'){
		if($result->num_rows == 1) {
			$db->query("RENAME TABLE medp_medical_providers TO medp_medical_providers_merged", true);
			$db->query("RENAME TABLE medp_medical_providers_orignal TO medp_medical_providers", true);
		}
			echo "Changed To Medical Providers Orignal Data...";die;
	}else{
		if($result->num_rows == 1) {
			$db->query("RENAME TABLE medp_medical_providers TO medp_medical_providers_orignal", true);
			$db->query("RENAME TABLE medp_medical_providers_merged TO medp_medical_providers", true);
		}
			echo "Changed To Medical Providers Merged Data...";die;
	}
}
	