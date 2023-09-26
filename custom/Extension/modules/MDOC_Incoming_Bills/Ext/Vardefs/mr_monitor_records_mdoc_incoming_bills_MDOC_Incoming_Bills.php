<?php
// created: 2020-04-09 00:19:18
$dictionary["MDOC_Incoming_Bills"]["fields"]["mr_monitor_records_mdoc_incoming_bills"] = array (
  'name' => 'mr_monitor_records_mdoc_incoming_bills',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mdoc_incoming_bills',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MDOC_INCOMING_BILLS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_mdoc_incoming_billsmr_monitor_records_ida',
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["mr_monitor_records_mdoc_incoming_bills_name"] = array (
  'name' => 'mr_monitor_records_mdoc_incoming_bills_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MDOC_INCOMING_BILLS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_mdoc_incoming_billsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_mdoc_incoming_bills',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["mr_monitor_records_mdoc_incoming_billsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_mdoc_incoming_billsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mdoc_incoming_bills',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MDOC_INCOMING_BILLS_FROM_MDOC_INCOMING_BILLS_TITLE',
);
