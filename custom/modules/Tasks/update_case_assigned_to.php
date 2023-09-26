<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class ht_update_task
{

 function update_case_assigned_to($bean, $event, $arguments){
	 global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name
				FROM `cases`
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE cases.deleted = 0 AND cases.id  = '{$bean->parent_id}'
			";
		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$bean->assigned_lawyer_cases = '<a target="_blank" style = "color: black;font-weight: bold;font-size: 13px;" href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
		}
 }

}

