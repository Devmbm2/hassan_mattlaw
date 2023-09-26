<?php
$dictionary['Account']['fields']['account_case_fields'] = array (
			'name' => 'account_case_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'account_case_id', 'account_role' => 'case_role'),
			'vname' => 'LBL_ACCOUNT_CASE_FIELDS',
			'type' => 'relate',
			'link' => 'cases',
			'link_type' => 'relationship_info',
			'join_link_name' => 'account_cases',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Account']['fields']['account_case_id'] = array (
			'name' => 'account_case_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_ACCOUNT_CASE_ID',
			'studio' => array('listview' => false),
);

$dictionary['Account']['fields']['case_role'] = array (
			'name' => 'case_role',
			'type' => 'enum',
    		'source' => 'non-db',
			'vname' => 'LBL_CASE_ACCOUNT_ROLE',
			'options' => 'relationship_to_case_list',
);

