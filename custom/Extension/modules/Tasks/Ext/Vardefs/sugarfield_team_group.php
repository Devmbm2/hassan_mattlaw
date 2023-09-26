<?php
$dictionary['Task']['fields']['team_group'] = array(
	'name' => 'team_group',
	'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
	'type' => 'enum',
	'source' => 'non-db',
	'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'len' => 70,
    'size' => '20',
    'function' => 'getList', 
);
