<?php
// created: 2020-04-09 00:19:18
$dictionary["mr_monitor_records_medr_medical_records"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mr_monitor_records_medr_medical_records' => 
    array (
      'lhs_module' => 'MR_Monitor_Records',
      'lhs_table' => 'mr_monitor_records',
      'lhs_key' => 'id',
      'rhs_module' => 'MEDR_Medical_Records',
      'rhs_table' => 'medr_medical_records',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mr_monitor_records_medr_medical_records_c',
      'join_key_lhs' => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
      'join_key_rhs' => 'mr_monitor_records_medr_medical_recordsmedr_medical_records_idb',
    ),
  ),
  'table' => 'mr_monitor_records_medr_medical_records_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mr_monitor_records_medr_medical_recordsmedr_medical_records_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mr_monitor_records_medr_medical_recordsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mr_monitor_records_medr_medical_records_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mr_monitor_records_medr_medical_recordsmr_monitor_records_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mr_monitor_records_medr_medical_records_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mr_monitor_records_medr_medical_recordsmedr_medical_records_idb',
      ),
    ),
  ),
);