<?php
$dictionary['Case']['fields']['cases_ht_damages'] = array(
	'name' => 'cases_ht_damages',
	'type' => 'link',
	'relationship' => 'cases_ht_damages',
	'source'=>'non-db',
	'module'=>'ht_Damages',
	'bean_name'=>'ht_Damages',
	'vname'=>'LBL_CASES_HT_DAMAGES'
	);
	
	// Relationship Definition
	$dictionary["Case"]["relationships"]['cases_ht_damages'] = array(
	'lhs_module'=> 'Cases',
	'lhs_table'=> 'cases',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_Damages',
	'rhs_table'=> 'ht_damages',
	'rhs_key' => 'case_id',
	'relationship_type'=>'one-to-many',
	);