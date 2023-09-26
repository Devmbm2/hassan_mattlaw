<?php
// created: 2018-08-17 15:14:58
$dictionary["mreq_medb_requests_medb_medical_bills"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mreq_medb_requests_medb_medical_bills' => 
    array (
      'lhs_module' => 'MEDB_Medical_Bills',
      'lhs_table' => 'medb_medical_bills',
      'lhs_key' => 'id',
      'rhs_module' => 'MREQ_MEDB_Requests',
      'rhs_table' => 'mreq_medb_requests',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mreq_medb_requests_medb_medical_bills_c',
      'join_key_lhs' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
      'join_key_rhs' => 'mreq_medb_requests_medb_medical_billsmreq_medb_requests_idb',
    ),
  ),
  'table' => 'mreq_medb_requests_medb_medical_bills_c',
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
      'name' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mreq_medb_requests_medb_medical_billsmreq_medb_requests_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mreq_medb_requests_medb_medical_billsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mreq_medb_requests_medb_medical_bills_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mreq_medb_requests_medb_medical_bills_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mreq_medb_requests_medb_medical_billsmreq_medb_requests_idb',
      ),
    ),
  ),
);