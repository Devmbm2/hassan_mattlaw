<?php
 // created: 2016-12-23 14:45:48
$dictionary['Lead']['fields']['lead_ht_address_book'] = array(
		'name' => 'lead_ht_address_book',
		'type' => 'link',
		'relationship' => 'lead_ht_address_book',
		'source'=>'non-db',
		'vname'=>'LBL_LEAD_HT_ADDRESS_BOOK'
	);

	// Relationship Definition
	$dictionary["Lead"]["relationships"]['lead_ht_address_book'] = array(
		'lhs_module'=> 'Leads',
		'lhs_table'=> 'leads',
		'lhs_key' => 'id', 
		'rhs_module'=> 'ht_address_book',
		'rhs_table'=> 'ht_address_book',
		'rhs_key' => 'lead_id',
		'relationship_type'=>'one-to-many',
	);
	
	
 ?>