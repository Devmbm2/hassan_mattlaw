<?php

$dictionary['ht_EmailExtract']['fields']['convert_to_module'] = array (
  	'name' => 'convert_to_module',
    'type' => 'enum',
	'module'=>'ht_EmailExtract',
	'bean_name'=>'ht_EmailExtract',
	'options'=>'moduleList',
	'vname'=>'LBL_CONVERT_TO_MODULE',
	'sortable' => false,
	'required' => true,
	'default' => 'Leads',
);