<?php
// created: 2017-06-15 17:44:33
$dictionary["medb_medical_bills_contacts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'medb_medical_bills_contacts' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'MEDB_Medical_Bills',
      'rhs_table' => 'medb_medical_bills',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'medb_medical_bills_contacts_c',
      'join_key_lhs' => 'medb_medical_bills_contactscontacts_ida',
      'join_key_rhs' => 'medb_medical_bills_contactsmedb_medical_bills_idb',
    ),
  ),
  'table' => 'medb_medical_bills_contacts_c',
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
      'name' => 'medb_medical_bills_contactscontacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'medb_medical_bills_contactsmedb_medical_bills_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'medb_medical_bills_contactsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'medb_medical_bills_contacts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'medb_medical_bills_contactscontacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'medb_medical_bills_contacts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'medb_medical_bills_contactsmedb_medical_bills_idb',
      ),
    ),
  ),
);