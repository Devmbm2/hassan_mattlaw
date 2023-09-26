<?php
// created: 2017-08-28 23:40:08
$dictionary["plea_pleadings_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'plea_pleadings_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'PLEA_Pleadings',
      'rhs_table' => 'plea_pleadings',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'plea_pleadings_cases_c',
      'join_key_lhs' => 'plea_pleadings_casescases_ida',
      'join_key_rhs' => 'plea_pleadings_casesplea_pleadings_idb',
    ),
  ),
  'table' => 'plea_pleadings_cases_c',
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
      'name' => 'plea_pleadings_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'plea_pleadings_casesplea_pleadings_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'plea_pleadings_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'plea_pleadings_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'plea_pleadings_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'plea_pleadings_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'plea_pleadings_casesplea_pleadings_idb',
      ),
    ),
  ),
);