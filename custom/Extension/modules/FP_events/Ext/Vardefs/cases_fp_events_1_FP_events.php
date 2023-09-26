<?php
// created: 2017-06-16 20:36:27
$dictionary["FP_events"]["fields"]["cases_fp_events_1"] = array (
  'name' => 'cases_fp_events_1',
  'type' => 'link',
  'relationship' => 'cases_fp_events_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
  'id_name' => 'cases_fp_events_1cases_ida',
);
$dictionary["FP_events"]["fields"]["cases_fp_events_1_name"] = array (
  'name' => 'cases_fp_events_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'cases_fp_events_1cases_ida',
  'link' => 'cases_fp_events_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
  'required' => true,
  'quicksearch' => 'enabled',
);
$dictionary["FP_events"]["fields"]["cases_fp_events_1cases_ida"] = array (
  'name' => 'cases_fp_events_1cases_ida',
  'type' => 'link',
  'relationship' => 'cases_fp_events_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CASES_FP_EVENTS_1_FROM_FP_EVENTS_TITLE',
);

