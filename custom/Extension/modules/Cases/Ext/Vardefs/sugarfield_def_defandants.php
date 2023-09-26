<?php
 // created: 2016-12-23 14:45:48
$dictionary['Case']['fields']['def_defendants_cases'] = array(
	'name' => 'def_defendants_cases',
	'type' => 'link',
	'relationship' => 'def_defendants_cases',
	'source'=>'non-db',
	'vname'=>'LBL_DEF_DEFENDANTS_CASES_C'
	);

	// Relationship Definition
	$dictionary["Case"]["relationships"]['def_defendants_cases'] = array(
	'lhs_module'=> 'Cases',
	'lhs_table'=> 'cases',
	'lhs_key' => 'id', 
	'rhs_module'=> 'DEF_Defendants',
	'rhs_table'=> 'def_defendants',
	'rhs_key' => 'acase_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>