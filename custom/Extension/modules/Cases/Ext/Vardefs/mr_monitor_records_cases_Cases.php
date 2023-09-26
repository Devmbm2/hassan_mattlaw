<?php
// created: 2020-04-09 00:19:18
$dictionary["Case"]["fields"]["mr_monitor_records_cases"] = array (
  'name' => 'mr_monitor_records_cases',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_cases',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CASES_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_casesmr_monitor_records_ida',
);
$dictionary["Case"]["fields"]["mr_monitor_records_cases_name"] = array (
  'name' => 'mr_monitor_records_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CASES_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_casesmr_monitor_records_ida',
  'link' => 'mr_monitor_records_cases',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["mr_monitor_records_casesmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_casesmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CASES_FROM_CASES_TITLE',
);
