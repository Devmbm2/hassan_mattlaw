<?php
// created: 2017-06-19 11:54:07
$dictionary["neg_negotiations_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'neg_negotiations_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'NEG_Negotiations',
      'rhs_table' => 'neg_negotiations',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'neg_negotiations_cases_c',
      'join_key_lhs' => 'neg_negotiations_casescases_ida',
      'join_key_rhs' => 'neg_negotiations_casesneg_negotiations_idb',
    ),
  ),
  'table' => 'neg_negotiations_cases_c',
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
      'name' => 'neg_negotiations_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'neg_negotiations_casesneg_negotiations_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'neg_negotiations_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'neg_negotiations_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'neg_negotiations_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'neg_negotiations_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'neg_negotiations_casesneg_negotiations_idb',
      ),
    ),
  ),
);