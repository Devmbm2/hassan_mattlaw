<?php
 // created: 2018-11-26 08:05:08
$dictionary['Document']['fields']['related_case_assigned_to'] = array(
	'name' => 'related_case_assigned_to',
	'vname' => 'LBL_RELATED_CASE_ASSIGNED_TO',
	'type' => 'varchar',
	'len' => '255',
	'source' => 'non-db',
	'function' => array('name'=>'get_related_document_case_assigned_to',
			 'returns'=>'html',
			 'include'=>'custom/include/custom_utils.php'),
	);