<?php
 // created: 2016-12-23 14:45:48
$dictionary['Contact']['fields']['contact_ht_radiology'] = array(
	'name' => 'contact_ht_radiology',
	'type' => 'link',
	'relationship' => 'contact_ht_radiology',
	'source'=>'non-db',
	'vname'=>'LBL_CONTACT_HT_RADIOLOGY'
	);

	// Relationship Definition
	$dictionary["Contact"]["relationships"]['contact_ht_radiology'] = array(
	'lhs_module'=> 'Contacts',
	'lhs_table'=> 'contacts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_radiology',
	'rhs_table'=> 'ht_radiology',
	'rhs_key' => 'contact_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>