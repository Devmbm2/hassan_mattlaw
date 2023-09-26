<?php

$query = '';
if(isset($_REQUEST['record_id']) && !empty($_REQUEST['record_id'])){
		$query = $_REQUEST['record_id'];
}else{
		$query = implode("','", $_REQUEST['mass']);
}
global $db, $current_user;
$sql = "SELECT *
		FROM documents
		WHERE deleted = 0 AND documents.id IN ('". $query ."')
		
		";	   
		
$result = $db->query($sql, true);
while($row = $db->fetchByAssoc($result)){
	$db->query("UPDATE documents SET outgoing_document = 1, hd_reviewed_date = NOW(), hd_reviewed_by = '{$current_user->id}' WHERE id = '{$row['id']}'");
}

if(empty($_REQUEST['record_id'])){
	SugarApplication::redirect("index.php?module=Documents&action=index");
}
