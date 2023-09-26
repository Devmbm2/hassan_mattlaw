<?php

$query = '';
if(isset($_REQUEST['record_id']) && !empty($_REQUEST['record_id'])){
		$query = $_REQUEST['record_id'];
}else{
		$query = implode("','", $_REQUEST['mass']);
}
global $db, $current_user;
$sql = "SELECT *
		FROM disc_discovery
		WHERE deleted = 0 AND disc_discovery.id IN ('". $query ."')
		
		";	   
$result = $db->query($sql, true);
$record_id=$_REQUEST['record_id'];
while($row = $db->fetchByAssoc($result)){
	$db->query("UPDATE disc_discovery SET done = 1, hd_reviewed_date = NOW(), hd_reviewed_by = '{$current_user->id}' WHERE id = '{$row['id']}'");
	// $quality_control_remarks = " SELECT *
	// FROM quality_control_remarks WHERE deleted = 0 AND record_id='{$record_id}' ";
	
	// 	$results = $db->query($quality_control_remarks,true);
	// 	if($results->num_rows > 0) {
	// 		$sql2 = "UPDATE quality_control_remarks SET status = 'mark_done'  WHERE record_id ='{$record_id}' AND deleted=0 ";
	// 	$result2 = $db->query($sql2);
	// 	}
	// 	else{
	// 	}
}
// while($row = $db->fetchByAssoc($result)){
// 	$db->query("UPDATE disc_discovery SET done = 1, hd_reviewed_date = NOW(), hd_reviewed_by = '{$current_user->id}' WHERE id = '{$row['id']}'");
// }

if(empty($_REQUEST['record_id'])){
		SugarApplication::redirect("index.php?module=DISC_Discovery&action=index");
}
