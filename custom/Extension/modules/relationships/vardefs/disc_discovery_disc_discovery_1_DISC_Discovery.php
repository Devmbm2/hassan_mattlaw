<?php
// created: 2018-06-30 17:19:47
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_disc_discovery_1"] = array (
  'name' => 'disc_discovery_disc_discovery_1',
  'type' => 'link',
  'relationship' => 'disc_discovery_disc_discovery_1',
  'source' => 'non-db',
  'module' => 'DISC_Discovery',
  'bean_name' => 'DISC_Discovery',
  'vname' => 'LBL_DISC_DISCOVERY_DISC_DISCOVERY_1_FROM_DISC_DISCOVERY_L_TITLE',
  'id_name' => 'disc_discovery_disc_discovery_1disc_discovery_ida',
);
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_disc_discovery_1_name"] = array (
  'name' => 'disc_discovery_disc_discovery_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DISC_DISCOVERY_DISC_DISCOVERY_1_FROM_DISC_DISCOVERY_L_TITLE',
  'save' => true,
  'id_name' => 'disc_discovery_disc_discovery_1disc_discovery_ida',
  'link' => 'disc_discovery_disc_discovery_1',
  'table' => 'disc_discovery',
  'module' => 'DISC_Discovery',
  'rname' => 'document_name',
);
$dictionary["DISC_Discovery"]["fields"]["disc_discovery_disc_discovery_1disc_discovery_ida"] = array (
  'name' => 'disc_discovery_disc_discovery_1disc_discovery_ida',
  'type' => 'link',
  'relationship' => 'disc_discovery_disc_discovery_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DISC_DISCOVERY_DISC_DISCOVERY_1_FROM_DISC_DISCOVERY_R_TITLE',
);
