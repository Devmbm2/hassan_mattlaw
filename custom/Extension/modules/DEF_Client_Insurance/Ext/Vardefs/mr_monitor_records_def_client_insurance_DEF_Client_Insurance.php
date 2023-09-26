<?php
// created: 2020-04-09 00:19:18
$dictionary["DEF_Client_Insurance"]["fields"]["mr_monitor_records_def_client_insurance"] = array (
  'name' => 'mr_monitor_records_def_client_insurance',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_def_client_insurance',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DEF_CLIENT_INSURANCE_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
);
$dictionary["DEF_Client_Insurance"]["fields"]["mr_monitor_records_def_client_insurance_name"] = array (
  'name' => 'mr_monitor_records_def_client_insurance_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DEF_CLIENT_INSURANCE_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
  'link' => 'mr_monitor_records_def_client_insurance',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["DEF_Client_Insurance"]["fields"]["mr_monitor_records_def_client_insurancemr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_def_client_insurance',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DEF_CLIENT_INSURANCE_FROM_DEF_CLIENT_INSURANCE_TITLE',
);
