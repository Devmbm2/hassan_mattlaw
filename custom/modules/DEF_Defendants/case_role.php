<?php

class def_role_class {
	
	function add_contacts_roles_defendents($bean, $event, $arguments)
	{
		global $db;
		
		$relation_mapping = array(
			'contacts' => array(
				'related_table' => 'contacts_cases',
				'role_field' => 'contact_role',
				'related_field' => 'contact_id',
			),
			'accounts' => array(
				'related_table' => 'accounts_cases',
				'role_field' => 'account_role',
				'related_field' => 'account_id',
			),
		);
		$field_role_mapping = array(
			'contact_id1_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Defendant',
			),
			'account_id1_c' => array(
				'relation' => 'accounts',
				'role_value' => 'Defendant',
			),
			'account_id_c' => array(
				'relation' => 'accounts',
				'role_value' => 'Insurance_Company',
			),
			'contact_id_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Adjuster',
			),
			'contact_id4_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Defense_Attorney',
			),
			'contact_id5_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Defense_Attorney2',
			),
		);
		if(!empty($bean->acase_id)){
			foreach($field_role_mapping AS $field_id => $field_pro){
				if(!empty($bean->$field_id) && ($bean->$field_id != $bean->fetched_row[$field_id])){
					$select = "SELECT id FROM {$relation_mapping[$field_pro['relation']]['related_table']}  WHERE {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND case_id = '{$bean->acase_id}' AND {$relation_mapping[$field_pro['relation']]['related_field']} = '{$bean->$field_id}' AND deleted = 0 ;";
					$result = $db->query($select, true);
					// var_dump($select);die;
					if($result->num_rows < 1){
						$insert = "INSERT INTO `{$relation_mapping[$field_pro['relation']]['related_table']}` (`id`, `{$relation_mapping[$field_pro['relation']]['related_field']}`, `{$relation_mapping[$field_pro['relation']]['role_field']}`, `case_id`, `date_modified`) VALUES (UUID(), '{$bean->$field_id}', '{$field_pro['role_value']}', '{$bean->acase_id}', NOW()); ";
						$db->query($insert, true);
					}
				}
				// $update = "UPDATE `{$relation_mapping[$field_pro['relation']]['related_table']}` SET `deleted`='1', date_modified = NOW() WHERE   {$relation_mapping[$field_pro['relation']]['related_field']} = '{$bean->fetched_row[$field_id]}' AND {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND `case_id` = '{$bean->fetched_row['acase_id']}'; ";
				// $db->query($update, true);
			}
		}
		
	}
	
}