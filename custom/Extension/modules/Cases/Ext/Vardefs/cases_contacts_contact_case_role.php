<?php
$dictionary['Case']['fields']['case_contact_fields'] = array (
			'name' => 'case_contact_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'case_role_id', 'case_role' => 'contact_role'),
			'vname' => 'LBL_CASE_CONTACT_FIELDS',
			'type' => 'relate',
			'link' => 'contacts',
			'link_type' => 'relationship_info',
			'join_link_name' => 'contacts_cases',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Case']['fields']['case_role_id'] = array (
			'name' => 'case_role_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_CONTACT_CASE_ID',
			'studio' => array('listview' => false),
);

$dictionary['Case']['fields']['contact_role'] = array (
	'name' => 'contact_role',
	'type' => 'enum',
	'source' => 'non-db',
	'vname' => 'LBL_CONTACT_CASE_ROLE',
	'options' => 'relationship_to_case_list',
);