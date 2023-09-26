<?php
$dictionary['Contact']['fields']['contact_case_fields'] = array (
			'name' => 'contact_case_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'contact_role_id', 'contact_role' => 'case_role'),
			'vname' => 'LBL_CONTACT_CASE_FIELDS',
			'type' => 'relate',
			'link' => 'cases',
			'link_type' => 'relationship_info',
			'join_link_name' => 'contacts_cases',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Contact']['fields']['contact_role_id'] = array (
			'name' => 'contact_role_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_CONTACT_CASE_ID',
			'studio' => array('listview' => false),
);

$dictionary['Contact']['fields']['case_role'] = array (
  'name' => 'case_role',
  'type' => 'enum',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACT_CASE_ROLE',
  'options' => 'relationship_to_case_list',
);
