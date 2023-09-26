<?php
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
	);
	$sql = "SELECT id FROM cases c
		INNER JOIN cases_cstm cs ON cs.id_c = c.id
		WHERE c.deleted = 0 AND c.status != 'Closed';";
	$result_cases = $db->query($sql, true);
	while ($resultrow = $result_cases->fetch_assoc()) {
		$case_bean = BeanFactory::getBean('Cases', $resultrow['id']);
		$case_bean->load_relationship('def_defendants_cases');
		$related_beans = $case_bean->def_defendants_cases->getBeans();
		foreach($related_beans AS  $rel_bean){
			foreach($field_role_mapping AS $field_id => $field_pro){
				$select = "SELECT id FROM {$relation_mapping[$field_pro['relation']]['related_table']}  WHERE {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND case_id = '{$case_bean->id}' AND {$relation_mapping[$field_pro['relation']]['related_field']} = '{$rel_bean->$field_id}' AND deleted = 0 ;";
				print"<pre>";print_r($select);print"</pre>";
				$result = $db->query($select, true);
				if($result->num_rows < 1){
					$insert = "INSERT INTO `{$relation_mapping[$field_pro['relation']]['related_table']}` (`id`, `{$relation_mapping[$field_pro['relation']]['related_field']}`, `{$relation_mapping[$field_pro['relation']]['role_field']}`, `case_id`, `date_modified`) VALUES (UUID(), '{$rel_bean->$field_id}', '{$field_pro['role_value']}', '{$case_bean->id}', NOW()); ";
					print"<pre>";print_r($insert);print"</pre>";
					$db->query($insert, true);
				}
			}
		}
	}
	echo 'DONE';