<?php
// created: 2020-04-09 00:19:18
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mr_monitor_records_mts_medical_treatment_summary"] = array (
  'name' => 'mr_monitor_records_mts_medical_treatment_summary',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mts_medical_treatment_summary',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MTS_MEDICAL_TREATMENT_SUMMARY_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitorf352records_ida',
);
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mr_monitor_records_mts_medical_treatment_summary_name"] = array (
  'name' => 'mr_monitor_records_mts_medical_treatment_summary_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MTS_MEDICAL_TREATMENT_SUMMARY_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitorf352records_ida',
  'link' => 'mr_monitor_records_mts_medical_treatment_summary',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mr_monitorf352records_ida"] = array (
  'name' => 'mr_monitorf352records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mts_medical_treatment_summary',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MTS_MEDICAL_TREATMENT_SUMMARY_FROM_MTS_MEDICAL_TREATMENT_SUMMARY_TITLE',
);
