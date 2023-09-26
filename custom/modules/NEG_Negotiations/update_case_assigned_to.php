<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class update_neg_negotiations
{

 function update_case_assigned_to($bean, $event, $arguments){
	 global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name, assistant.id as assistant_id, CONCAT_WS(' ',assistant.first_name, assistant.last_name) as assistant_name
				FROM `neg_negotiations`
				INNER JOIN neg_negotiations_cases_c ON (neg_negotiations_cases_c.deleted = 0 AND neg_negotiations_cases_c.neg_negotiations_casesneg_negotiations_idb= neg_negotiations.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = neg_negotiations_cases_c.neg_negotiations_casescases_ida)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				INNER JOIN users assistant ON (assistant.deleted = 0 AND cases.default_assistant_lawyer_id = assistant.id)
				WHERE neg_negotiations.id  = '{$bean->id}'
			";
		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$bean->related_case_assigned_to = '<a target="_blank" style = "color: black;font-weight: bold;font-size: 13px;" href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
			$bean->related_case_assistant = '<a target="_blank" style = "color: black;font-weight: bold;font-size: 13px;" href="index.php?module=Users&action=DetailView&record='.$row['assistant_id'].'">
			'.$row['assistant_name'].'</a>';
		}
 }

}

