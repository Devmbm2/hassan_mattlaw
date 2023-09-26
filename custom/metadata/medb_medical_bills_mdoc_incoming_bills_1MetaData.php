<?php
// created: 2018-08-17 15:40:04
$dictionary["medb_medical_bills_mdoc_incoming_bills_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'medb_medical_bills_mdoc_incoming_bills_1' => 
    array (
      'lhs_module' => 'MEDB_Medical_Bills',
      'lhs_table' => 'medb_medical_bills',
      'lhs_key' => 'id',
      'rhs_module' => 'MDOC_Incoming_Bills',
      'rhs_table' => 'mdoc_incoming_bills',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'medb_medical_bills_mdoc_incoming_bills_1_c',
      'join_key_lhs' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
      'join_key_rhs' => 'medb_medical_bills_mdoc_incoming_bills_1mdoc_incoming_bills_idb',
    ),
  ),
  'table' => 'medb_medical_bills_mdoc_incoming_bills_1_c',
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
      'name' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'medb_medical_bills_mdoc_incoming_bills_1mdoc_incoming_bills_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'medb_medical_bills_mdoc_incoming_bills_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'medb_medical_bills_mdoc_incoming_bills_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'medb_medical_bills_mdoc_incoming_bills_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'medb_medical_bills_mdoc_incoming_bills_1mdoc_incoming_bills_idb',
      ),
    ),
  ),
);