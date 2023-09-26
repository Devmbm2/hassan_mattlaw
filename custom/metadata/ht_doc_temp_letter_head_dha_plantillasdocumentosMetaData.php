<?php
// created: 2018-12-26 09:44:05
$dictionary["ht_doc_temp_letter_head_dha_plantillasdocumentos"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'ht_doc_temp_letter_head_dha_plantillasdocumentos' => 
    array (
      'lhs_module' => 'ht_doc_temp_letter_head',
      'lhs_table' => 'ht_doc_temp_letter_head',
      'lhs_key' => 'id',
      'rhs_module' => 'DHA_PlantillasDocumentos',
      'rhs_table' => 'dha_plantillasdocumentos',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ht_doc_temp_letter_head_dha_plantillasdocumentos_c',
      'join_key_lhs' => 'ht_doc_temffa9er_head_ida',
      'join_key_rhs' => 'ht_doc_temed6aumentos_idb',
    ),
  ),
  'table' => 'ht_doc_temp_letter_head_dha_plantillasdocumentos_c',
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
      'name' => 'ht_doc_temffa9er_head_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ht_doc_temed6aumentos_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ht_doc_temp_letter_head_dha_plantillasdocumentosspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ht_doc_temp_letter_head_dha_plantillasdocumentos_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'ht_doc_temffa9er_head_ida',
        1 => 'ht_doc_temed6aumentos_idb',
      ),
    ),
  ),
);