<?php
// created: 2020-04-09 00:19:18
$dictionary["COMP_Companions"]["fields"]["mr_monitor_records_comp_companions"] = array (
  'name' => 'mr_monitor_records_comp_companions',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_comp_companions',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COMP_COMPANIONS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
);
$dictionary["COMP_Companions"]["fields"]["mr_monitor_records_comp_companions_name"] = array (
  'name' => 'mr_monitor_records_comp_companions_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COMP_COMPANIONS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_comp_companions',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["COMP_Companions"]["fields"]["mr_monitor_records_comp_companionsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_comp_companions',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COMP_COMPANIONS_FROM_COMP_COMPANIONS_TITLE',
);
