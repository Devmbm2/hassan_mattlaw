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
			'account_id_c' => array(
				'relation' => 'accounts',
				'role_value' => 'Insurance_Company',
			),
			'contact_id_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Adjuster',
			),
			'contact_id1_c' => array(
				'relation' => 'contacts',
				'role_value' => 'Defense_Attorney',
			),
			'contact_id2' => array(
				'relation' => 'contacts',
				'role_value' => 'Defense_Attorney2',
			),
		);
		$case_id = '';
		if (gettype($bean->def_client_insurance_cases_1cases_ida) == 'object'){
			if($bean->load_relationship('def_client_insurance_cases_1')){
				$cases = $bean->def_client_insurance_cases_1->getBeans();
				$cases = reset($cases);
				$case_id = $cases->id;
			}
		}else{
			$case_id = $bean->def_client_insurance_cases_1cases_ida;
		}
		if(!empty($case_id)){
			foreach($field_role_mapping AS $field_id => $field_pro){
				if(!empty($bean->$field_id) && ($bean->$field_id != $bean->fetched_row[$field_id])){
				    $table = $relation_mapping[$field_pro['relation']]['related_table'];
					$where = $relation_mapping[$field_pro['relation']]['role_field']. " = '{$field_pro['role_value']}' AND case_id = '{$case_id}' AND {$relation_mapping[$field_pro['relation']]['related_field']} = '{$bean->$field_id}' AND deleted = 0";
					$select = "SELECT id FROM $table  WHERE $where";
					$result = $db->query($select, true);
					if($result->num_rows < 1){
						$insert = "INSERT INTO `{$relation_mapping[$field_pro['relation']]['related_table']}` (`id`, `{$relation_mapping[$field_pro['relation']]['related_field']}`, `{$relation_mapping[$field_pro['relation']]['role_field']}`, `case_id`, `date_modified`) VALUES (UUID(), '{$bean->$field_id}', '{$field_pro['role_value']}', '{$case_id}', NOW()); ";
						$db->query($insert, true);
					}
				}
			}
		}
		
	}
	
}