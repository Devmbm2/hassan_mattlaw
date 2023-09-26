<?php
// created: 2020-04-09 00:19:18
$dictionary["MREQ_MEDB_Requests"]["fields"]["mr_monitor_records_mreq_medb_requests"] = array (
  'name' => 'mr_monitor_records_mreq_medb_requests',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mreq_medb_requests',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MREQ_MEDB_REQUESTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_mreq_medb_requestsmr_monitor_records_ida',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mr_monitor_records_mreq_medb_requests_name"] = array (
  'name' => 'mr_monitor_records_mreq_medb_requests_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MREQ_MEDB_REQUESTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_mreq_medb_requestsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_mreq_medb_requests',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mr_monitor_records_mreq_medb_requestsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_mreq_medb_requestsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_mreq_medb_requests',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
);
