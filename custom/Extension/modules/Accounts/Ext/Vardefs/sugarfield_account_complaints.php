<?php
 // created: 2018-10-02 14:22:59
$dictionary['Account']['fields']['complaints'] = array(
	'name' => 'complaints',
	'type' => 'link',
	'relationship' => 'account_complaints',
	'module' => 'Complaints',
	'bean_name' => 'Complaint',
	'source' => 'non-db',
	'vname' => 'LBL_COMPLAINTS',
);

$dictionary['Account']['relationships']['account_complaints'] = array(
	'lhs_module' => 'Accounts',
	'lhs_table' => 'accounts',
	'lhs_key' => 'id',
	'rhs_module' => 'Complaints',
	'rhs_table' => 'complaints',
	'rhs_key' => 'id',
	'relationship_type' => 'many-to-many',
	'join_table' => 'account_complaints',
	'join_key_lhs' => 'account_id',
	'join_key_rhs' => 'complaint_id',
);


?>