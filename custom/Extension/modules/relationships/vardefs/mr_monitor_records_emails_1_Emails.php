<?php
// created: 2020-04-15 02:28:50
$dictionary["Email"]["fields"]["mr_monitor_records_emails_1"] = array (
  'name' => 'mr_monitor_records_emails_1',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_emails_1',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_EMAILS_1_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_emails_1mr_monitor_records_ida',
);
$dictionary["Email"]["fields"]["mr_monitor_records_emails_1_name"] = array (
  'name' => 'mr_monitor_records_emails_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_EMAILS_1_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_emails_1mr_monitor_records_ida',
  'link' => 'mr_monitor_records_emails_1',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Email"]["fields"]["mr_monitor_records_emails_1mr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_emails_1mr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_emails_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_EMAILS_1_FROM_EMAILS_TITLE',
);
