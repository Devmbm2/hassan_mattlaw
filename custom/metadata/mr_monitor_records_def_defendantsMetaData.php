<?php
// created: 2020-04-09 00:19:18
$dictionary["mr_monitor_records_def_defendants"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mr_monitor_records_def_defendants' => 
    array (
      'lhs_module' => 'MR_Monitor_Records',
      'lhs_table' => 'mr_monitor_records',
      'lhs_key' => 'id',
      'rhs_module' => 'DEF_Defendants',
      'rhs_table' => 'def_defendants',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mr_monitor_records_def_defendants_c',
      'join_key_lhs' => 'mr_monitor_records_def_defendantsmr_monitor_records_ida',
      'join_key_rhs' => 'mr_monitor_records_def_defendantsdef_defendants_idb',
    ),
  ),
  'table' => 'mr_monitor_records_def_defendants_c',
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
      'name' => 'mr_monitor_records_def_defendantsmr_monitor_records_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mr_monitor_records_def_defendantsdef_defendants_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mr_monitor_records_def_defendantsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mr_monitor_records_def_defendants_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mr_monitor_records_def_defendantsmr_monitor_records_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mr_monitor_records_def_defendants_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mr_monitor_records_def_defendantsdef_defendants_idb',
      ),
    ),
  ),
);