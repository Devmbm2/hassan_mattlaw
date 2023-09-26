<?php
// created: 2019-09-24 09:18:57
$dictionary["ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head"] = array (
  'true_relationship_type' => 'one-to-one',
  'relationships' => 
  array (
    'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head' => 
    array (
      'lhs_module' => 'ht_doc_temp_multi_letterhead',
      'lhs_table' => 'ht_doc_temp_multi_letterhead',
      'lhs_key' => 'id',
      'rhs_module' => 'ht_doc_temp_letter_head',
      'rhs_table' => 'ht_doc_temp_letter_head',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_c',
      'join_key_lhs' => 'ht_doc_tem2268terhead_ida',
      'join_key_rhs' => 'ht_doc_tem1d8aer_head_idb',
    ),
  ),
  'table' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_c',
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
      'name' => 'ht_doc_tem2268terhead_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ht_doc_tem1d8aer_head_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_headspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'ht_doc_tem2268terhead_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'ht_doc_tem1d8aer_head_idb',
      ),
    ),
  ),
);