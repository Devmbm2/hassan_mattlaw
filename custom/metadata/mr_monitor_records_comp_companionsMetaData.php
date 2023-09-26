<?php
// created: 2020-04-09 00:19:18
$dictionary["mr_monitor_records_comp_companions"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mr_monitor_records_comp_companions' => 
    array (
      'lhs_module' => 'MR_Monitor_Records',
      'lhs_table' => 'mr_monitor_records',
      'lhs_key' => 'id',
      'rhs_module' => 'COMP_Companions',
      'rhs_table' => 'comp_companions',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mr_monitor_records_comp_companions_c',
      'join_key_lhs' => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
      'join_key_rhs' => 'mr_monitor_records_comp_companionscomp_companions_idb',
    ),
  ),
  'table' => 'mr_monitor_records_comp_companions_c',
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
      'name' => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mr_monitor_records_comp_companionscomp_companions_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mr_monitor_records_comp_companionsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mr_monitor_records_comp_companions_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mr_monitor_records_comp_companionsmr_monitor_records_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mr_monitor_records_comp_companions_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mr_monitor_records_comp_companionscomp_companions_idb',
      ),
    ),
  ),
);