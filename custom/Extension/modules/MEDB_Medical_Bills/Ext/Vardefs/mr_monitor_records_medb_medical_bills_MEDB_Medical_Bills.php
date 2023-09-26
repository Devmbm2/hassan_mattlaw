<?php
// created: 2020-04-09 00:19:18
$dictionary["MEDB_Medical_Bills"]["fields"]["mr_monitor_records_medb_medical_bills"] = array (
  'name' => 'mr_monitor_records_medb_medical_bills',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_medb_medical_bills',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDB_MEDICAL_BILLS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_medb_medical_billsmr_monitor_records_ida',
);
$dictionary["MEDB_Medical_Bills"]["fields"]["mr_monitor_records_medb_medical_bills_name"] = array (
  'name' => 'mr_monitor_records_medb_medical_bills_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDB_MEDICAL_BILLS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_medb_medical_billsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_medb_medical_bills',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["MEDB_Medical_Bills"]["fields"]["mr_monitor_records_medb_medical_billsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_medb_medical_billsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_medb_medical_bills',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
);
