<?php
 // created: 2016-12-23 14:45:48
$dictionary['Account']['fields']['account_ht_address_book'] = array(
	'name' => 'account_ht_address_book',
	'type' => 'link',
	'relationship' => 'account_ht_address_book',
	'source'=>'non-db',
	'vname'=>'LBL_ACCOUNT_HT_ADDRESS_BOOK'
	);

	// Relationship Definition
	$dictionary["Account"]["relationships"]['account_ht_address_book'] = array(
	'lhs_module'=> 'Accounts',
	'lhs_table'=> 'accounts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_address_book',
	'rhs_table'=> 'ht_address_book',
	'rhs_key' => 'account_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>