<?php
// created: 2020-11-10 07:25:26
$dictionary["ht_vehicles_cases_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'ht_vehicles_cases_1' => 
    array (
      'lhs_module' => 'ht_vehicles',
      'lhs_table' => 'ht_vehicles',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ht_vehicles_cases_1_c',
      'join_key_lhs' => 'ht_vehicles_cases_1ht_vehicles_ida',
      'join_key_rhs' => 'ht_vehicles_cases_1cases_idb',
    ),
  ),
  'table' => 'ht_vehicles_cases_1_c',
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
      'name' => 'ht_vehicles_cases_1ht_vehicles_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ht_vehicles_cases_1cases_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ht_vehicles_cases_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ht_vehicles_cases_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'ht_vehicles_cases_1ht_vehicles_ida',
        1 => 'ht_vehicles_cases_1cases_idb',
      ),
    ),
  ),
);