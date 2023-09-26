<?php
// created: 2020-04-09 00:19:18
$dictionary["FP_events"]["fields"]["mr_monitor_records_fp_events"] = array (
  'name' => 'mr_monitor_records_fp_events',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_fp_events',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_FP_EVENTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_fp_eventsmr_monitor_records_ida',
);
$dictionary["FP_events"]["fields"]["mr_monitor_records_fp_events_name"] = array (
  'name' => 'mr_monitor_records_fp_events_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_FP_EVENTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_fp_eventsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_fp_events',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["FP_events"]["fields"]["mr_monitor_records_fp_eventsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_fp_eventsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_fp_events',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_FP_EVENTS_FROM_FP_EVENTS_TITLE',
);
