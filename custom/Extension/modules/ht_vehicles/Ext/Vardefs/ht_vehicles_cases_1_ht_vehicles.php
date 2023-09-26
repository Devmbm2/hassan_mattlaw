<?php
$dictionary["ht_vehicles"]["fields"]["ht_vehicles_cases_1"] = array (
  'name' => 'ht_vehicles_cases_1',
  'type' => 'link',
  'relationship' => 'ht_vehicles_cases_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_HT_VEHICLES_CASES_1_FROM_CASES_TITLE',
  'id_name' => 'ht_vehicles_cases_1cases_ida',
);
$dictionary["ht_vehicles"]["fields"]["ht_vehicles_cases_1_name"] = array (
  'name' => 'ht_vehicles_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HT_VEHICLES_CASES_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'ht_vehicles_cases_1cases_ida',
  'link' => 'ht_vehicles_cases_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["ht_vehicles"]["fields"]["ht_vehicles_cases_1cases_ida"] = array (
  'name' => 'ht_vehicles_cases_1cases_ida',
  'type' => 'link',
  'relationship' => 'ht_vehicles_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_HT_VEHICLES_CASES_1_FROM_HT_CASE_EVENT_TITLE',
);