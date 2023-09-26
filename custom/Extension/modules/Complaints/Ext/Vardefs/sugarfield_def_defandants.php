<?php
 // created: 2016-12-23 14:45:48
$dictionary['Complaint']['fields']['def_defendants_complaints'] = array(
	'name' => 'def_defendants_complaints',
	'type' => 'link',
	'relationship' => 'def_defendants_complaints',
	'source'=>'non-db',
	'vname'=>'LBL_DEF_DEFENDANTS_COMPLAINTS_C'
	);

	// Relationship Definition
	$dictionary["Complaint"]["relationships"]['def_defendants_complaints'] = array(
	'lhs_module'=> 'Complaints',
	'lhs_table'=> 'complaints',
	'lhs_key' => 'id', 
	'rhs_module'=> 'DEF_Defendants',
	'rhs_table'=> 'def_defendants',
	'rhs_key' => 'complaint_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>