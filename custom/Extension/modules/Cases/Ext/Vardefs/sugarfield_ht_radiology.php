<?php
 // created: 2016-12-23 14:45:48
$dictionary['Case']['fields']['case_ht_radiology'] = array(
	'name' => 'case_ht_radiology',
	'type' => 'link',
	'relationship' => 'case_ht_radiology',
	'source'=>'non-db',
	'vname'=>'LBL_CASE_HT_RADIOLOGY'
	);

	// Relationship Definition
	$dictionary["Case"]["relationships"]['case_ht_radiology'] = array(
	'lhs_module'=> 'Cases',
	'lhs_table'=> 'cases',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_radiology',
	'rhs_table'=> 'ht_radiology',
	'rhs_key' => 'case_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>