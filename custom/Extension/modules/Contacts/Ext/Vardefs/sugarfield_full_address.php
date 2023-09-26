<?php

$dictionary["Contact"]["fields"]['full_address'] = array(
	'name' => 'full_address',
	'rname' => 'full_address',
	'vname' => 'LBL_NAME',
	'type' => 'name',
	'link' => true,
	'fields' => 
	array (
		'primary_address_street',
		'primary_address_city',
		'primary_address_state',
		'primary_address_postalcode',
		'primary_address_country',
	),
	'sort_on' => 'primary_address_street',
	'source' => 'non-db',
	'group' => 'primary_address_street',
	'len' => '255',
	'db_fields_separator' => ', ',
	'db_concat_fields' => 
	array (		
		'primary_address_street',
		'primary_address_city',
		'primary_address_state',
		'primary_address_postalcode',
		'primary_address_country',
	),
	'importable' => 'false',
);
