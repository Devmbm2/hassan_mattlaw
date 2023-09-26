<?php
// created: 2020-04-09 00:19:18
$dictionary["Task"]["fields"]["mr_monitor_records_tasks"] = array (
  'name' => 'mr_monitor_records_tasks',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_tasks',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_TASKS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_tasksmr_monitor_records_ida',
);
$dictionary["Task"]["fields"]["mr_monitor_records_tasks_name"] = array (
  'name' => 'mr_monitor_records_tasks_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_TASKS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_tasksmr_monitor_records_ida',
  'link' => 'mr_monitor_records_tasks',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Task"]["fields"]["mr_monitor_records_tasksmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_tasksmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_tasks',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_TASKS_FROM_TASKS_TITLE',
);
