<?php
 // created: 2016-12-23 14:45:48
$dictionary['Contact']['fields']['contact_ht_sms'] = array(
	'name' => 'contact_ht_sms',
	'type' => 'link',
	'relationship' => 'contact_ht_sms',
	'source'=>'non-db',
	'vname'=>'LBL_CONTACT_HT_SMS'
	);

	// Relationship Definition
	$dictionary["Contact"]["relationships"]['contact_ht_sms'] = array(
	'lhs_module'=> 'Contacts',
	'lhs_table'=> 'contacts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_sms',
	'rhs_table'=> 'ht_sms',
	'rhs_key' => 'contact_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>