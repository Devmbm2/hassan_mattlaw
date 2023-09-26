<?php

$dictionary["Account"]["fields"]['full_address'] = array(
	'name' => 'full_address',
	'rname' => 'full_address',
	'vname' => 'LBL_NAME',
	'type' => 'name',
	'link' => true,
	'fields' => 
	array (
		'billing_address_street',
		'billing_address_city',
		'billing_address_state',
		'billing_address_postalcode',
		'billing_address_country',
	),
	'sort_on' => 'billing_address_street',
	'source' => 'non-db',
	'group' => 'billing_address_street',
	'len' => '255',
	'db_fields_separator' => ', ',
	'db_concat_fields' => 
	array (		
		'billing_address_street',
		'billing_address_city',
		'billing_address_state',
		'billing_address_postalcode',
		'billing_address_country',
	),
	'importable' => 'false',
);
