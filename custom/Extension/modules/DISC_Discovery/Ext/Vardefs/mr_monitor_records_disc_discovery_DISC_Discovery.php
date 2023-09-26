<?php
// created: 2020-04-09 00:19:18
$dictionary["DISC_Discovery"]["fields"]["mr_monitor_records_disc_discovery"] = array (
  'name' => 'mr_monitor_records_disc_discovery',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_disc_discovery',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DISC_DISCOVERY_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_disc_discoverymr_monitor_records_ida',
);
$dictionary["DISC_Discovery"]["fields"]["mr_monitor_records_disc_discovery_name"] = array (
  'name' => 'mr_monitor_records_disc_discovery_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DISC_DISCOVERY_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_disc_discoverymr_monitor_records_ida',
  'link' => 'mr_monitor_records_disc_discovery',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["DISC_Discovery"]["fields"]["mr_monitor_records_disc_discoverymr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_disc_discoverymr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_disc_discovery',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DISC_DISCOVERY_FROM_DISC_DISCOVERY_TITLE',
);
