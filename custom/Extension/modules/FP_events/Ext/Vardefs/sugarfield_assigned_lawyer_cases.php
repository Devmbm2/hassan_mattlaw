<?php
$dictionary['FP_events']['fields']['assigned_lawyer_cases'] = array (
	'name' => 'assigned_lawyer_cases',
	'label' => 'LBL_ASSIGNED_LAWYER_CASES',
	'type' => 'enum',
	'source' => 'non-db',
	'options' => 'assigned_lawyer_cases_list',
  );
$dictionary['FP_events']['fields']['case_status'] = array (
      'name' => 'case_status',
      'vname' => 'LBL_STATUS',
      'type' => 'enum',
	  'source' => 'non-db',
      'options' => 'case_status_dom',
   
    );