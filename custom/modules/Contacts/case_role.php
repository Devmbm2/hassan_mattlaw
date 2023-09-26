<?php

class contact_case_role_class {
	function contact_case_role_method($bean, $event, $arguments)
	{
		global $db;
		/* print"<pre>";print_r($_REQUEST);die; */
		if($_REQUEST['return_module'] == 'Cases' && !empty($_REQUEST['return_id'])){
			if(!empty($bean->case_role)){
				$insert = "UPDATE contacts_cases SET case_role = '{$bean->case_role}' WHERE case_id = '{$_REQUEST['return_id']}' AND contact_id = '{$bean->id}'";
				/* echo $insert;die; */
				$db->query($insert, true);
			}
		}
	}
	
}
