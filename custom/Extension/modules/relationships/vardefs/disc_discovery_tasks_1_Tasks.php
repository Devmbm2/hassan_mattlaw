<?php
// created: 2018-06-30 17:14:50
$dictionary["Task"]["fields"]["disc_discovery_tasks_1"] = array (
  'name' => 'disc_discovery_tasks_1',
  'type' => 'link',
  'relationship' => 'disc_discovery_tasks_1',
  'source' => 'non-db',
  'module' => 'DISC_Discovery',
  'bean_name' => 'DISC_Discovery',
  'vname' => 'LBL_DISC_DISCOVERY_TASKS_1_FROM_DISC_DISCOVERY_TITLE',
  'id_name' => 'disc_discovery_tasks_1disc_discovery_ida',
);
$dictionary["Task"]["fields"]["disc_discovery_tasks_1_name"] = array (
  'name' => 'disc_discovery_tasks_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DISC_DISCOVERY_TASKS_1_FROM_DISC_DISCOVERY_TITLE',
  'save' => true,
  'id_name' => 'disc_discovery_tasks_1disc_discovery_ida',
  'link' => 'disc_discovery_tasks_1',
  'table' => 'disc_discovery',
  'module' => 'DISC_Discovery',
  'rname' => 'document_name',
);
$dictionary["Task"]["fields"]["disc_discovery_tasks_1disc_discovery_ida"] = array (
  'name' => 'disc_discovery_tasks_1disc_discovery_ida',
  'type' => 'link',
  'relationship' => 'disc_discovery_tasks_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DISC_DISCOVERY_TASKS_1_FROM_TASKS_TITLE',
);
