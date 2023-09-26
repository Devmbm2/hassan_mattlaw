<?php
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
	$sql = "SELECT id FROM complaints c
		INNER JOIN complaints_cstm cs ON cs.id_c = c.id
		WHERE c.deleted = 0 AND c.status != 'Closed';";
	$result_complaints = $db->query($sql, true);
	while ($resultrow = $result_complaints->fetch_assoc()) {
		$complaint_bean = BeanFactory::getBean('Complaints', $resultrow['id']);
		$complaint_bean->load_relationship('def_defendants_complaints');
		$related_beans = $complaint_bean->def_defendants_complaints->getBeans();
		foreach($related_beans AS  $rel_bean){
			foreach($field_role_mapping AS $field_id => $field_pro){
				$select = "SELECT id FROM {$relation_mapping[$field_pro['relation']]['related_table']}  WHERE {$relation_mapping[$field_pro['relation']]['role_field']} = '{$field_pro['role_value']}' AND complaint_id = '{$complaint_bean->id}' AND {$relation_mapping[$field_pro['relation']]['related_field']} = '{$rel_bean->$field_id}' AND deleted = 0 ;";
				print"<pre>";print_r($select);print"</pre>";
				$result = $db->query($select, true);
				if($result->num_rows < 1){
					$insert = "INSERT INTO `{$relation_mapping[$field_pro['relation']]['related_table']}` (`id`, `{$relation_mapping[$field_pro['relation']]['related_field']}`, `{$relation_mapping[$field_pro['relation']]['role_field']}`, `complaint_id`, `date_modified`) VALUES (UUID(), '{$rel_bean->$field_id}', '{$field_pro['role_value']}', '{$complaint_bean->id}', NOW()); ";
					print"<pre>";print_r($insert);print"</pre>";
					$db->query($insert, true);
				}
			}
		}
	}
	echo 'DONE';