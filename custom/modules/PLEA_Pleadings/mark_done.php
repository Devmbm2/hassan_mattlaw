<?php
ob_clean();
$query = '';
if(isset($_REQUEST['record_id']) && !empty($_REQUEST['record_id'])){
		$query = $_REQUEST['record_id'];
}else{
		$query = implode("','", $_REQUEST['mass']);
}
global $db, $current_user;
$sql = "SELECT *
		FROM plea_pleadings
		WHERE deleted = 0 AND plea_pleadings.id IN ('". $query ."')
		
		";	
		
$result = $db->query($sql, true);
while($row = $db->fetchByAssoc($result)){
	$update = "UPDATE plea_pleadings SET outgoing_document = 1, hd_reviewed_date = NOW(), hd_reviewed_by = '{$current_user->id}' WHERE id = '{$row['id']}'";
	/* echo $update;die; */
	$db->query($update, true);
}

if(empty($_REQUEST['record_id'])){
		SugarApplication::redirect("index.php?module=PLEA_Pleadings&action=index");
}
