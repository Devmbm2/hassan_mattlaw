<?php
// created: 2020-04-09 00:19:18
$dictionary["PLEA_Pleadings"]["fields"]["mr_monitor_records_plea_pleadings"] = array (
  'name' => 'mr_monitor_records_plea_pleadings',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_plea_pleadings',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_PLEA_PLEADINGS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_plea_pleadingsmr_monitor_records_ida',
);
$dictionary["PLEA_Pleadings"]["fields"]["mr_monitor_records_plea_pleadings_name"] = array (
  'name' => 'mr_monitor_records_plea_pleadings_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_PLEA_PLEADINGS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_plea_pleadingsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_plea_pleadings',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["PLEA_Pleadings"]["fields"]["mr_monitor_records_plea_pleadingsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_plea_pleadingsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_plea_pleadings',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_PLEA_PLEADINGS_FROM_PLEA_PLEADINGS_TITLE',
);
