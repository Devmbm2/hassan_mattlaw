<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class update_documents
{

 function update_case_assigned_to($bean, $event, $arguments){
	 global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name, assistant.id as assistant_id, CONCAT_WS(' ',assistant.first_name, assistant.last_name) as assistant_name
				FROM `documents`
				INNER JOIN documents_cases ON (documents_cases.deleted = 0 AND documents_cases.document_id = documents.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = documents_cases.case_id)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				INNER JOIN users assistant ON (assistant.deleted = 0 AND cases.default_assistant_lawyer_id = assistant.id)
				WHERE documents.id  = '{$bean->id}'
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

