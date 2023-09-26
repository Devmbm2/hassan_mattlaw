<?php

$dictionary["Contact"]["fields"]['mt_full_name'] = array(
	'name' => 'mt_full_name',
	'rname' => 'mt_full_name',
	'vname' => 'LBL_NAME',
	'type' => 'name',
	'link' => true,
	'fields' => 
	array (
		'salutation',
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
	),
	'sort_on' => 'first_name',
	'source' => 'non-db',
	'group' => 'first_name',
	'len' => '255',
	'db_concat_fields' => 
	array (		
		'salutation',
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
	),
	'importable' => 'false',
);

$dictionary["Contact"]["fields"]['fmls_name'] = array(
	'name' => 'fmls_name',
	'rname' => 'fmls_name',
	'vname' => 'LBL_NAME',
	'type' => 'name',
	'link' => true,
	'fields' => 
	array (
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
	),
	'sort_on' => 'first_name',
	'source' => 'non-db',
	'group' => 'first_name',
	'len' => '255',
	'db_concat_fields' => 
	array (		
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
	),
	'importable' => 'false',
);

$dictionary["Contact"]["fields"]['fml_name'] = array(
	'name' => 'fml_name',
	'rname' => 'fml_name',
	'vname' => 'LBL_NAME',
	'type' => 'name',
	'link' => true,
	'fields' => 
	array (
		'first_name',
		'middle_name',
		'last_name',
	),
	'sort_on' => 'first_name',
	'source' => 'non-db',
	'group' => 'first_name',
	'len' => '255',
	'db_concat_fields' => 
	array (		
		'first_name',
		'middle_name',
		'last_name',
	),
	'importable' => 'false',
);
