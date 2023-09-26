<?php

class account_case_role_class {
	function account_case_role_method($bean, $event, $arguments)
	{
		global $db;
		if($_REQUEST['return_module'] == 'Cases' && !empty($_REQUEST['return_id'])){
			if(!empty($bean->contact_role)){
				$insert = "UPDATE accounts_cases SET contact_role = '{$bean->contact_role}' WHERE case_id = '{$_REQUEST['return_id']}' AND account_id = '{$bean->id}'";
				$db->query($insert, true);
			}
		}
	}
	
}
