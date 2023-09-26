<?php
// created: 2017-06-15 18:28:51
$dictionary["medr_medical_records_contacts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'medr_medical_records_contacts' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'MEDR_Medical_Records',
      'rhs_table' => 'medr_medical_records',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'medr_medical_records_contacts_c',
      'join_key_lhs' => 'medr_medical_records_contactscontacts_ida',
      'join_key_rhs' => 'medr_medical_records_contactsmedr_medical_records_idb',
    ),
  ),
  'table' => 'medr_medical_records_contacts_c',
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
      'name' => 'medr_medical_records_contactscontacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'medr_medical_records_contactsmedr_medical_records_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'medr_medical_records_contactsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'medr_medical_records_contacts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'medr_medical_records_contactscontacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'medr_medical_records_contacts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'medr_medical_records_contactsmedr_medical_records_idb',
      ),
    ),
  ),
);