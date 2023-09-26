<?php
// created: 2020-04-09 00:19:18
$dictionary["COST_Client_Cost"]["fields"]["mr_monitor_records_cost_client_cost"] = array (
  'name' => 'mr_monitor_records_cost_client_cost',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_cost_client_cost',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COST_CLIENT_COST_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
);
$dictionary["COST_Client_Cost"]["fields"]["mr_monitor_records_cost_client_cost_name"] = array (
  'name' => 'mr_monitor_records_cost_client_cost_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COST_CLIENT_COST_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
  'link' => 'mr_monitor_records_cost_client_cost',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["COST_Client_Cost"]["fields"]["mr_monitor_records_cost_client_costmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_cost_client_cost',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_COST_CLIENT_COST_FROM_COST_CLIENT_COST_TITLE',
);
