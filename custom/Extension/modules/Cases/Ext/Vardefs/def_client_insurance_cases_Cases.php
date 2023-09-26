<?php
// created: 2017-06-06 17:12:58
$dictionary["Case"]["fields"]["def_client_insurance_cases"] = array (
  'name' => 'def_client_insurance_cases',
  'type' => 'link',
  'relationship' => 'def_client_insurance_cases',
  'source' => 'non-db',
  'module' => 'DEF_Client_Insurance',
  'bean_name' => false,
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_FROM_DEF_CLIENT_INSURANCE_TITLE',
  'id_name' => 'def_client_insurance_casesdef_client_insurance_ida',
);
$dictionary["Case"]["fields"]["def_client_insurance_cases_name"] = array (
  'name' => 'def_client_insurance_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_FROM_DEF_CLIENT_INSURANCE_TITLE',
  'save' => true,
  'id_name' => 'def_client_insurance_casesdef_client_insurance_ida',
  'link' => 'def_client_insurance_cases',
  'table' => 'def_client_insurance',
  'module' => 'DEF_Client_Insurance',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["def_client_insurance_casesdef_client_insurance_ida"] = array (
  'name' => 'def_client_insurance_casesdef_client_insurance_ida',
  'type' => 'link',
  'relationship' => 'def_client_insurance_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DEF_CLIENT_INSURANCE_CASES_FROM_CASES_TITLE',
);
