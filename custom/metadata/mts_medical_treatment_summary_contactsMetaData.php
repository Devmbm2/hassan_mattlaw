<?php
// created: 2018-01-20 19:59:20
$dictionary["mts_medical_treatment_summary_contacts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mts_medical_treatment_summary_contacts' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'MTS_Medical_Treatment_Summary',
      'rhs_table' => 'mts_medical_treatment_summary',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mts_medical_treatment_summary_contacts_c',
      'join_key_lhs' => 'mts_medical_treatment_summary_contactscontacts_ida',
      'join_key_rhs' => 'mts_medicafdf2summary_idb',
    ),
  ),
  'table' => 'mts_medical_treatment_summary_contacts_c',
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
      'name' => 'mts_medical_treatment_summary_contactscontacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mts_medicafdf2summary_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mts_medical_treatment_summary_contactsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mts_medical_treatment_summary_contacts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mts_medical_treatment_summary_contactscontacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mts_medical_treatment_summary_contacts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mts_medicafdf2summary_idb',
      ),
    ),
  ),
);