<?php
// created: 2022-08-03 13:18:36
$dictionary["neg_negotiations_calls_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'neg_negotiations_calls_1' => 
    array (
      'lhs_module' => 'NEG_Negotiations',
      'lhs_table' => 'neg_negotiations',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'neg_negotiations_calls_1_c',
      'join_key_lhs' => 'neg_negotiations_calls_1neg_negotiations_ida',
      'join_key_rhs' => 'neg_negotiations_calls_1calls_idb',
    ),
  ),
  'table' => 'neg_negotiations_calls_1_c',
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
      'name' => 'neg_negotiations_calls_1neg_negotiations_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'neg_negotiations_calls_1calls_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'neg_negotiations_calls_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'neg_negotiations_calls_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'neg_negotiations_calls_1neg_negotiations_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'neg_negotiations_calls_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'neg_negotiations_calls_1calls_idb',
      ),
    ),
  ),
);