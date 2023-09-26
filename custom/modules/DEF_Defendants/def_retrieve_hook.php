<?php
if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
class def_retrieve_hook {
	 
    function get_related_fields(&$bean, $event, $arguments) {
		if(isset($bean->contact_id4_c)){
			global $db;
			$query = "SELECT a.name FROM `contacts` c
			INNER JOIN accounts_contacts ac ON (c.id = ac.contact_id AND ac.deleted = 0) 
			INNER JOIN accounts a ON (a.id = ac.account_id AND a.deleted = 0) 
			WHERE c.id = '{$bean->contact_id4_c}' AND c.deleted = 0;";
			$rs = $db->query($query);
			$row = $db->fetchByAssoc($rs);
			$bean->defense_attorney_account_name = 	$row['name'];
		}
	}
}

?>
