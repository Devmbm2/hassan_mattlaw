<?php

class SaveContact {
	function save_role($bean, $event, $arguments)
	{
		//print"<pre>";print_r($_REQUEST);die;
		if($_REQUEST['return_module'] == 'Cases' && !empty($_REQUEST['return_id']) && !empty($_REQUEST['contact_role'])){
				$sql = "SELECT * FROM `contacts_cases` WHERE case_id = '{$_REQUEST['return_id']}' AND contact_id = '{$bean->contact_id_c}' LIMIT 1";
				$result = $GLOBALS['db']->query($sql, true);
				if($result->num_rows < 1){
					//$check = true;
					//$insert = "UPDATE contacts_cases SET contact_role = '{$_REQUEST['contact_role']}' WHERE contact_id = '{$bean->contact_id_c}' AND case_id = '{$_REQUEST['return_id']}'";
					$insert = "INSERT INTO contacts_cases (id, contact_id, case_id, contact_role, date_modified)
								VALUES (UUID(), '{$bean->contact_id_c}', '{$_REQUEST['return_id']}', '{$_REQUEST['contact_role']}', NOW());";
					$GLOBALS['db']->query($insert, true);
				}
	
				
			
		} 
	}
	
}