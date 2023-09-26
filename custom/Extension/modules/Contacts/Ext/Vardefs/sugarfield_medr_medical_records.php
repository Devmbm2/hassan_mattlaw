<?php

	$dictionary['Contact']['fields']['contact_medr_medical_records'] = array(
		'name' => 'contact_medr_medical_records',
		'type' => 'link',
		'relationship' => 'contact_medr_medical_records',
		'source'=>'non-db',
		'vname'=>'LBL_CONTACT_MEDR_MEDICAL_RECORDS'
	);

	$dictionary["Contact"]["relationships"]['contact_medr_medical_records'] = array(
		'lhs_module'=> 'Contacts',
		'lhs_table'=> 'contacts',
		'lhs_key' => 'id', 
		'rhs_module'=> 'MEDR_Medical_Records',
		'rhs_table'=> 'medr_medical_records',
		'rhs_key' => 'contact_id',
		'relationship_type'=>'one-to-many',
	);