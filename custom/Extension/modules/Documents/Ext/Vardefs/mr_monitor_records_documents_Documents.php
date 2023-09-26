<?php
// created: 2020-04-09 00:19:18
$dictionary["Document"]["fields"]["mr_monitor_records_documents"] = array (
  'name' => 'mr_monitor_records_documents',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_documents',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DOCUMENTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_documentsmr_monitor_records_ida',
);
$dictionary["Document"]["fields"]["mr_monitor_records_documents_name"] = array (
  'name' => 'mr_monitor_records_documents_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DOCUMENTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_documentsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_documents',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Document"]["fields"]["mr_monitor_records_documentsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_documentsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_documents',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_DOCUMENTS_FROM_DOCUMENTS_TITLE',
);
