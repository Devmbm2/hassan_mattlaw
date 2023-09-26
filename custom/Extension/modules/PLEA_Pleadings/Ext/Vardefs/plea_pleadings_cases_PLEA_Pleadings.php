<?php
// created: 2017-08-28 23:40:08
$dictionary["PLEA_Pleadings"]["fields"]["plea_pleadings_cases"] = array (
  'name' => 'plea_pleadings_cases',
  'type' => 'link',
  'relationship' => 'plea_pleadings_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
  'id_name' => 'plea_pleadings_casescases_ida',
);
$dictionary["PLEA_Pleadings"]["fields"]["plea_pleadings_cases_name"] = array (
  'name' => 'plea_pleadings_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'required' => true,
  'id_name' => 'plea_pleadings_casescases_ida',
  'link' => 'plea_pleadings_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["PLEA_Pleadings"]["fields"]["plea_pleadings_casescases_ida"] = array (
  'name' => 'plea_pleadings_casescases_ida',
  'type' => 'link',
  'relationship' => 'plea_pleadings_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PLEA_PLEADINGS_CASES_FROM_PLEA_PLEADINGS_TITLE',
);
