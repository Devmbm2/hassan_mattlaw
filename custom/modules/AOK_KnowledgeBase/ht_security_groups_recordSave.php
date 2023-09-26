<?php
class ht_security_groups_recordSave{
function groupTeamSave($bean, $event, $arguments){
	global $db;
	$group_id = $_REQUEST['massassign_group'];
	$sql = "Select count(*) as totalcount FROM securitygroups_records WHERE record_id = '{$bean->id}'";
	$result = $db->query($sql);
	$row = $db->fetchByAssoc($result);
	$count = $row['totalcount'];
	if ($count == 0 )
			 { 
			 	// if($bean->assigned_type == 'Team'){
			 		$sql2 = "INSERT into securitygroups_records VALUES (uuid(),'".$bean->assigned_team."','".$bean->id."','AOK_KnowledgeBase','".$bean->date_modified."','".$bean->modified_user_id."','".$bean->created_by."',0)";
			 		$result2 = $db->query($sql2);
			 	// }
			 }
			 else
			 {
			 	$sql2 = "Update securitygroups_records SET securitygroup_id = '".$bean->assigned_team."' where record_id = '".$bean->id."'";
			 		$result2 = $db->query($sql2);
			 }
}



}