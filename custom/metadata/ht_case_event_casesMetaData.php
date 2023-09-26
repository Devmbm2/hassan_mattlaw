<?php
// created: 2017-12-15 04:39:29
$dictionary["ht_case_event_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'ht_case_event_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'ht_case_event',
      'rhs_table' => 'ht_case_event',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ht_case_event_cases_c',
      'join_key_lhs' => 'ht_case_event_casescases_ida',
      'join_key_rhs' => 'ht_case_event_casesht_case_event_idb',
    ),
  ),
  'table' => 'ht_case_event_cases_c',
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
      'name' => 'ht_case_event_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ht_case_event_casesht_case_event_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ht_case_event_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ht_case_event_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'ht_case_event_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'ht_case_event_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'ht_case_event_casesht_case_event_idb',
      ),
    ),
  ),
);