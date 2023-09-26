<?php
 // created: 2016-12-23 14:45:48
$dictionary['Contact']['fields']['contact_document'] = array(
	'name' => 'contact_document',
	'type' => 'link',
	'relationship' => 'contact_document',
	'source'=>'non-db',
	'vname'=>'LBL_DOCUMENTS'
	);

	// Relationship Definition
	$dictionary["Contact"]["relationships"]['contact_document'] = array(
	'lhs_module'=> 'Contacts',
	'lhs_table'=> 'contacts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'Documents',
	'rhs_table'=> 'documents',
	'rhs_key' => 'contact_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>