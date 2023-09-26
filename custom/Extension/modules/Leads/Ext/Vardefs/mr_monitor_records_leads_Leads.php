<?php
// created: 2020-04-09 00:19:18
$dictionary["Lead"]["fields"]["mr_monitor_records_leads"] = array (
  'name' => 'mr_monitor_records_leads',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_leads',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_LEADS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_leadsmr_monitor_records_ida',
);
$dictionary["Lead"]["fields"]["mr_monitor_records_leads_name"] = array (
  'name' => 'mr_monitor_records_leads_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_LEADS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_leadsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_leads',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Lead"]["fields"]["mr_monitor_records_leadsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_leadsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_leads',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_LEADS_FROM_LEADS_TITLE',
);
