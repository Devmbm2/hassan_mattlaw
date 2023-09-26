<?php

$dictionary["Account"]["fields"]['medical_provider_account'] = array (
	'name' => 'medical_provider_account',
	'type' => 'link',
	'relationship' => 'medical_provider_account',
	'source'=>'non-db',
	'vname'=>'LBL_MEDICAL_PROVIDER_ACCOUNT'
);

$dictionary["Account"]["relationships"]['medical_provider_account'] = array (
	'lhs_module'=> 'Accounts',
	'lhs_table'=> 'accounts',
	'lhs_key' => 'id', 
	'rhs_module'=> 'MEDB_Medical_Bills',
	'rhs_table'=> 'medb_medical_bills',
	'rhs_key' => 'account_id_c',
	'relationship_type'=>'one-to-many',
);
