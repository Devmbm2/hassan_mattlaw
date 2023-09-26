<?php

global $db;

/* $sql = "SELECT id, assigned_user_id 
		FROM fp_events 
		";
		
$result = $db->query($sql, true);

While($row = $db->fetchByAssoc($result)){
	if(empty($row['assigned_user_id'])) continue;
	$update_field = '^'.$row['assigned_user_id'].'^';
	$update = "UPDATE fp_events SET multiple_assigned_users = '{$update_field}' WHERE id = '{$row['id']}'";
	$db->query($update, true);
} */

$sql = "SELECT id, assigned_user_id 
		FROM tasks 
		";
		
$result = $db->query($sql, true);

While($row = $db->fetchByAssoc($result)){
	if(empty($row['assigned_user_id'])) continue;
	$update_field = '^'.$row['assigned_user_id'].'^';
	$update = "UPDATE tasks SET multiple_assigned_users = '{$update_field}' WHERE id = '{$row['id']}'";
	$db->query($update, true);
} 
echo 'done';die;