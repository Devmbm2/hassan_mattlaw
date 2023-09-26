<?php
 // created: 2018-01-10 13:46:53
$dictionary['Document']['fields']['duration'] = array(
	'name' => 'duration',
	'vname' => 'LBL_DURATION',
	'type' => 'enum',
	'source' => 'non-db',
	'options' => 'duration_dom',
	'source' => 'non-db',
	'comment' => 'Duration handler dropdown',
	'massupdate' => false,
	'reportable' => false,
	'importable' => false,
	);
$dictionary['Document']['fields']['date_start'] = array(
	'name' => 'date_start',
	'vname' => 'LBL_DATE',
	'type' => 'datetimecombo',
	'source' => 'non-db',
	'comment' => 'Date of start of meeting',
	'importable' => 'required',
	'required' => false,
	'enable_range_search' => true,
	'options' => 'date_range_search_dom',
	'validation' => array('type' => 'isbefore', 'compareto' => 'date_end', 'blank' => false),
	);
$dictionary['Document']['fields']['duration_hours'] = array(
	'name' => 'duration_hours',
	'vname' => 'LBL_DURATION_HOURS',
	'type' => 'int',
	'source' => 'non-db',
	'group' => 'duration',
	'len' => '3',
	'comment' => 'Duration (hours)',
	'importable' => 'required',
	'required' => false,
	);
$dictionary['Document']['fields']['duration_minutes'] = array(
	'name' => 'duration_minutes',
	'vname' => 'LBL_DURATION_MINUTES',
	'type' => 'int',
	'source' => 'non-db',
	'group' => 'duration',
	'len' => '2',
	'comment' => 'Duration (minutes)',
	);
$dictionary['Document']['fields']['date_end'] = array(
	'name' => 'date_end',
	'vname' => 'LBL_DATE_END',
	'type' => 'datetimecombo',
	'dbType' => 'datetime',
	'source' => 'non-db',
	'massupdate' => false,
	'comment' => 'Date meeting ends',
	'enable_range_search' => true,
	'options' => 'date_range_search_dom',
	);
$dictionary['Document']['fields']['create_event'] = array(
	'name' => 'create_event',
	'vname' => 'LBL_CREATE_EVENT',
	'type' => 'bool',
	'source' => 'non-db',
	);