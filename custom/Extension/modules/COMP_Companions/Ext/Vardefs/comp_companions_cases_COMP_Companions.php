<?php
// created: 2017-06-19 18:18:09
$dictionary["COMP_Companions"]["fields"]["comp_companions_cases"] = array (
  'name' => 'comp_companions_cases',
  'type' => 'link',
  'relationship' => 'comp_companions_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
  'id_name' => 'comp_companions_casescases_ida',
);
$dictionary["COMP_Companions"]["fields"]["comp_companions_cases_name"] = array (
  'name' => 'comp_companions_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'comp_companions_casescases_ida',
  'link' => 'comp_companions_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
  'required' => true,
);
$dictionary["COMP_Companions"]["fields"]["comp_companions_casescases_ida"] = array (
  'name' => 'comp_companions_casescases_ida',
  'type' => 'link',
  'relationship' => 'comp_companions_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_COMP_COMPANIONS_CASES_FROM_COMP_COMPANIONS_TITLE',
);
