<?php

class complaint_role_class {
	function complaint_role_method($bean, $event, $arguments)
	{
		global $db;
		if($_REQUEST['return_module'] == 'Accounts' && !empty($_REQUEST['return_id'])){
			if(!empty($bean->account_role)){
				$insert = "UPDATE accounts_complaints SET account_role = '{$bean->account_role}' WHERE complaint_id = '{$bean->id}' AND account_id = '{$_REQUEST['return_id']}'";
				$db->query($insert, true);
			}
		}
		
		if($_REQUEST['return_module'] == 'Contacts' && !empty($_REQUEST['return_id'])){
			if(!empty($bean->contact_role)){
				$insert = "UPDATE contacts_complaints SET contact_role = '{$bean->contact_role}' WHERE complaint_id = '{$bean->id}' AND contact_id = '{$_REQUEST['return_id']}'";
				$db->query($insert, true);
			}
		}
	}
	
	function add_contacts_roles($bean, $event, $arguments)
	{
		global $db;
		
		$relation_mapping = array(
			'contacts' => array(
				'related_table' => 'contacts_complaints',
				'role_field' => 'contact_role',
				'related_field' => 'contact_id',
			),
			'accounts' => array(
				'related_table' => 'accounts_complaints',
				'role_field' => 'account_role',
				'related_field' => 'account_id',
			),
		);
		$field_role_mapping = array(
			'contact_id1_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Client',
			),
			'contact_id2_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Injured_Person',
			),
			'contact_id3_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Referral_Attorney',
			),
			'contact_id4_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Referral_Non_Attorney',
			),
			'contact_id_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Judge',
			),
			'account_id_c' => array(
				'relation' => 'accounts',
				'role_value' => 'Police',
			),
		);
		foreach($field_role_mapping AS $field_id => $field_pro){
			if($bean->$field_id != $bean->fetched_row[$field_id]){
				$select = "SELECT id FROM {$relation_mapping[$field_pro['relation']]['related_table']}  WHERE {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND complaint_id = '{$bean->id}' AND {$relation_mapping[$field_pro['relation']]['related_field']} = '{$bean->$field_id}' AND deleted = 0 ;";
				$result = $db->query($select, true);
				if($result->num_rows < 1){
					$insert = "INSERT INTO `{$relation_mapping[$field_pro['relation']]['related_table']}` (`id`, `{$relation_mapping[$field_pro['relation']]['related_field']}`, `{$relation_mapping[$field_pro['relation']]['role_field']}`, `complaint_id`, `date_modified`) VALUES (UUID(), '{$bean->$field_id}', '{$field_pro['role_value']}', '{$bean->id}', NOW()); ";
					$db->query($insert, true);
				}
				$update = "UPDATE `{$relation_mapping[$field_pro['relation']]['related_table']}` SET `deleted`='1', date_modified = NOW() WHERE   {$relation_mapping[$field_pro['relation']]['related_field']} = '{$bean->fetched_row[$field_id]}' AND {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND `complaint_id` = '{$bean->id}'; ";
				$db->query($update, true);
			}
		}
		
	}
	
}