<?php
// created: 2017-06-06 17:12:58
$dictionary["DEF_Client_Insurance"]["fields"]["def_client_insurance_cases_1"] = array (
  'name' => 'def_client_insurance_cases_1',
  'type' => 'link',
  'relationship' => 'def_client_insurance_cases_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_CASES_TITLE',
  'id_name' => 'def_client_insurance_cases_1cases_ida',
);
$dictionary["DEF_Client_Insurance"]["fields"]["def_client_insurance_cases_1_name"] = array (
  'name' => 'def_client_insurance_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'def_client_insurance_cases_1cases_ida',
  'link' => 'def_client_insurance_cases_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
  'required' => true,
);
$dictionary["DEF_Client_Insurance"]["fields"]["def_client_insurance_cases_1cases_ida"] = array (
  'name' => 'def_client_insurance_cases_1cases_ida',
  'type' => 'link',
  'relationship' => 'def_client_insurance_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_DEF_CLIENT_INSURANCE_TITLE',
);
