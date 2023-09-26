<?php
// created: 2017-06-13 13:49:07
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_cases"] = array (
  'name' => 'disc_discovery_cases',
  'type' => 'link',
  'relationship' => 'disc_discovery_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
  'id_name' => 'disc_discovery_casescases_ida',
);
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_cases_name"] = array (
  'name' => 'disc_discovery_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
  'save' => true,
  'required' => true,
  'id_name' => 'disc_discovery_casescases_ida',
  'link' => 'disc_discovery_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_casescases_ida"] = array (
  'name' => 'disc_discovery_casescases_ida',
  'type' => 'link',
  'relationship' => 'disc_discovery_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DISC_DISCOVERY_CASES_FROM_DISC_DISCOVERY_TITLE',
);
