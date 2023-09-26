<?php
// created: 2017-06-13 17:19:09
$dictionary["COST_Client_Cost"]["fields"]["cost_client_cost_cases"] = array (
  'name' => 'cost_client_cost_cases',
  'type' => 'link',
  'relationship' => 'cost_client_cost_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
  'id_name' => 'cost_client_cost_casescases_ida',
  'reportable' => true,
);
$dictionary["COST_Client_Cost"]["fields"]["cost_client_cost_cases_name"] = array (
  'name' => 'cost_client_cost_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
  'save' => true,
  'required' => true,
  'id_name' => 'cost_client_cost_casescases_ida',
  'link' => 'cost_client_cost_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["COST_Client_Cost"]["fields"]["cost_client_cost_casescases_ida"] = array (
  'name' => 'cost_client_cost_casescases_ida',
  'type' => 'link',
  'relationship' => 'cost_client_cost_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_COST_CLIENT_COST_CASES_FROM_COST_CLIENT_COST_TITLE',
  'reportable' => true,
);
