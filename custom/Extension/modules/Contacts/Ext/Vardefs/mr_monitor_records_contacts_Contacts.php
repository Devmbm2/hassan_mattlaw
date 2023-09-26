<?php
// created: 2020-04-09 00:19:18
$dictionary["Contact"]["fields"]["mr_monitor_records_contacts"] = array (
  'name' => 'mr_monitor_records_contacts',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_contacts',
  'source' => 'non-db',
  'module' => 'MR_Monitor_Records',
  'bean_name' => 'MR_Monitor_Records',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CONTACTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'id_name' => 'mr_monitor_records_contactsmr_monitor_records_ida',
);
$dictionary["Contact"]["fields"]["mr_monitor_records_contacts_name"] = array (
  'name' => 'mr_monitor_records_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CONTACTS_FROM_MR_MONITOR_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'mr_monitor_records_contactsmr_monitor_records_ida',
  'link' => 'mr_monitor_records_contacts',
  'table' => 'mr_monitor_records',
  'module' => 'MR_Monitor_Records',
  'rname' => 'name',
);
$dictionary["Contact"]["fields"]["mr_monitor_records_contactsmr_monitor_records_ida"] = array (
  'name' => 'mr_monitor_records_contactsmr_monitor_records_ida',
  'type' => 'link',
  'relationship' => 'mr_monitor_records_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MR_MONITOR_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
);
