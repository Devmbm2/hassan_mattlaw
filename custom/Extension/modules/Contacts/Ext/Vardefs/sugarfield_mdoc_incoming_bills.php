<?php

	$dictionary['Contact']['fields']['contact_mdoc_incoming_bills'] = array(
		'name' => 'contact_mdoc_incoming_bills',
		'type' => 'link',
		'relationship' => 'contact_mdoc_incoming_bills',
		'source'=>'non-db',
		'vname'=>'LBL_CONTACT_MDOC_INCOMING_BILLS'
	);

	$dictionary["Contact"]["relationships"]['contact_mdoc_incoming_bills'] = array(
		'lhs_module'=> 'Contacts',
		'lhs_table'=> 'contacts',
		'lhs_key' => 'id', 
		'rhs_module'=> 'MDOC_Incoming_Bills',
		'rhs_table'=> 'mdoc_incoming_bills_cstm',
		'rhs_key' => 'contact_id_c',
		'relationship_type'=>'one-to-many',
	);