<?php
 // created: 2016-12-23 14:45:48
$dictionary['Contact']['fields']['contact_ht_address_book'] = array(
	'name' => 'contact_ht_address_book',
	'type' => 'link',
	'relationship' => 'contact_ht_address_book',
	'source'=>'non-db',
	'vname'=>'LBL_CONTACT_HT_ADDRESS_BOOK'
	);

	// Relationship Definition
	$dictionary["Contact"]["relationships"]['contact_ht_address_book'] = array(
	'lhs_module'=> 'Contacts',
	'lhs_table'=> 'contacts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_address_book',
	'rhs_table'=> 'ht_address_book',
	'rhs_key' => 'contact_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>