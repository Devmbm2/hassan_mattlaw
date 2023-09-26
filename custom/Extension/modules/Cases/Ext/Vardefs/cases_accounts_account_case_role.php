<?php
$dictionary['Case']['fields']['case_account_fields'] = array (
			'name' => 'case_account_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'case_account_id', 'case_role' => 'account_role'),
			'vname' => 'LBL_CASE_ACCOUNT_FIELDS',
			'type' => 'relate',
			'link' => 'accounts',
			'link_type' => 'relationship_info',
			'join_link_name' => 'account_cases',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Case']['fields']['case_account_id'] = array (
			'name' => 'case_account_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_CASE_ACCOUNT_ID',
			'studio' => array('listview' => false),
);

$dictionary['Case']['fields']['account_role'] = array (
			'name' => 'account_role',
			'type' => 'enum',
    		'source' => 'non-db',
			'vname' => 'LBL_ACCOUNT_CASE_ROLE',
			'options' => 'relationship_to_case_list',
);

