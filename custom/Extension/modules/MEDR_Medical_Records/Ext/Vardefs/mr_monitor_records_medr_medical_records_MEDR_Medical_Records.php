<?php
// created: 2020-04-09 00:19:18
$dictionary["MEDR_Medical_Records"]["fields"]["mr_monitor_records_medr_medical_records"] = array (
  'name' => 'mr_monitor_records_medr_medical_records',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_medr_medical_records',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDR_MEDICAL_RECORDS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
);
$dictionary["MEDR_Medical_Records"]["fields"]["mr_monitor_records_medr_medical_records_name"] = array (
  'name' => 'mr_monitor_records_medr_medical_records_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDR_MEDICAL_RECORDS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_medr_medical_records',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["MEDR_Medical_Records"]["fields"]["mr_monitor_records_medr_medical_recordsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_medr_medical_records',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MEDR_MEDICAL_RECORDS_FROM_MEDR_MEDICAL_RECORDS_TITLE',
);
