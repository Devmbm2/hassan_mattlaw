<?php
$dictionary['Complaint']['fields']['complaint_account_fields'] = array (
			'name' => 'complaint_account_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'complaint_account_id', 'account_role' => 'account_complaint_role'),
			'vname' => 'LBL_COMPLAINT_ACCOUNT_FIELDS',
			'type' => 'relate',
			'link' => 'accounts',
			'link_type' => 'relationship_info',
			'join_link_name' => 'account_complaints',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Complaint']['fields']['complaint_account_id'] = array (
			'name' => 'complaint_account_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_COMPLAINT_ACCOUNT_ID',
			'studio' => array('listview' => false),
);

$dictionary['Complaint']['fields']['account_complaint_role'] = array (
			'name' => 'account_complaint_role',
			'type' => 'enum',
    			'source' => 'non-db',
			'vname' => 'LBL_ACCOUNT_COMPLAINT_ROLE',
			'options' => 'relationship_to_complaint_list',
            		'link' => 'accounts', 
			//'rname_link' => 'complaint_role',
			'rname_link' => 'account_role',
);

