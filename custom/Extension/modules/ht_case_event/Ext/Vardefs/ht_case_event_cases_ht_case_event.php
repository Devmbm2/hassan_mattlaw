<?php
// created: 2017-12-15 04:39:29
$dictionary["ht_case_event"]["fields"]["ht_case_event_cases"] = array (
  'name' => 'ht_case_event_cases',
  'type' => 'link',
  'relationship' => 'ht_case_event_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_HT_CASE_EVENT_CASES_FROM_CASES_TITLE',
  'id_name' => 'ht_case_event_casescases_ida',
);
$dictionary["ht_case_event"]["fields"]["ht_case_event_cases_name"] = array (
  'name' => 'ht_case_event_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HT_CASE_EVENT_CASES_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'ht_case_event_casescases_ida',
  'link' => 'ht_case_event_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["ht_case_event"]["fields"]["ht_case_event_casescases_ida"] = array (
  'name' => 'ht_case_event_casescases_ida',
  'type' => 'link',
  'relationship' => 'ht_case_event_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_HT_CASE_EVENT_CASES_FROM_HT_CASE_EVENT_TITLE',
);
