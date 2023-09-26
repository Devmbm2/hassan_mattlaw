<?php
// created: 2017-06-19 11:54:07
$dictionary["NEG_Negotiations"]["fields"]["neg_negotiations_cases"] = array (
  'name' => 'neg_negotiations_cases',
  'type' => 'link',
  'relationship' => 'neg_negotiations_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
  'id_name' => 'neg_negotiations_casescases_ida',
);
$dictionary["NEG_Negotiations"]["fields"]["neg_negotiations_cases_name"] = array (
  'name' => 'neg_negotiations_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'required' => true,
  'id_name' => 'neg_negotiations_casescases_ida',
  'link' => 'neg_negotiations_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["NEG_Negotiations"]["fields"]["neg_negotiations_casescases_ida"] = array (
  'name' => 'neg_negotiations_casescases_ida',
  'type' => 'link',
  'relationship' => 'neg_negotiations_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_NEG_NEGOTIATIONS_TITLE',
);
