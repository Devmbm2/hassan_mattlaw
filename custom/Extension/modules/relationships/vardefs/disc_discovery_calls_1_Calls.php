<?php
// created: 2022-08-03 11:47:54
$dictionary["Call"]["fields"]["disc_discovery_calls_1"] = array (
  'name' => 'disc_discovery_calls_1',
  'type' => 'link',
  'relationship' => 'disc_discovery_calls_1',
  'source' => 'non-db',
  'module' => 'DISC_Discovery',
  'bean_name' => 'DISC_Discovery',
  'vname' => 'LBL_DISC_DISCOVERY_CALLS_1_FROM_DISC_DISCOVERY_TITLE',
  'id_name' => 'disc_discovery_calls_1disc_discovery_ida',
);
$dictionary["Call"]["fields"]["disc_discovery_calls_1_name"] = array (
  'name' => 'disc_discovery_calls_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DISC_DISCOVERY_CALLS_1_FROM_DISC_DISCOVERY_TITLE',
  'save' => true,
  'id_name' => 'disc_discovery_calls_1disc_discovery_ida',
  'link' => 'disc_discovery_calls_1',
  'table' => 'disc_discovery',
  'module' => 'DISC_Discovery',
  'rname' => 'document_name',
);
$dictionary["Call"]["fields"]["disc_discovery_calls_1disc_discovery_ida"] = array (
  'name' => 'disc_discovery_calls_1disc_discovery_ida',
  'type' => 'link',
  'relationship' => 'disc_discovery_calls_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DISC_DISCOVERY_CALLS_1_FROM_CALLS_TITLE',
);
