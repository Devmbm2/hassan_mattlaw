<?php

$dictionary['FP_events']['fields']['hold_dates'] = array(
	'required' => false,
	'name' => 'hold_dates',
	'vname' => 'LBL_HOLD_DATES',
	'type' => 'function',
	'source' => 'non-db',
	'massupdate' => 0,
	'importable' => 'false',
	'duplicate_merge' => 'disabled',
	'duplicate_merge_dom_value' => 0,
	'audited' => false,
	'reportable' => false,
	'inline_edit' => false,
	'function' =>
		array(
			'name' => 'display_hold_dates_fields',
			'returns' => 'html',
			'include' => 'custom/modules/FP_events/hold_dates.php'
		),
);

$dictionary['FP_events']['fields']['hold_dates_data'] = array(
	'name' => 'hold_dates_data',
	'vname' => 'LBL_HOLD_DATES_DATA',
	'type' => 'text',
);