<?php
// created: 2020-04-09 00:19:18
$dictionary["NEG_Negotiations"]["fields"]["mr_monitor_records_neg_negotiations"] = array (
  'name' => 'mr_monitor_records_neg_negotiations',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_neg_negotiations',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_NEG_NEGOTIATIONS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_neg_negotiationsmr_monitor_records_ida',
);
$dictionary["NEG_Negotiations"]["fields"]["mr_monitor_records_neg_negotiations_name"] = array (
  'name' => 'mr_monitor_records_neg_negotiations_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_NEG_NEGOTIATIONS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_neg_negotiationsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_neg_negotiations',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["NEG_Negotiations"]["fields"]["mr_monitor_records_neg_negotiationsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_neg_negotiationsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_neg_negotiations',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_NEG_NEGOTIATIONS_FROM_NEG_NEGOTIATIONS_TITLE',
);
