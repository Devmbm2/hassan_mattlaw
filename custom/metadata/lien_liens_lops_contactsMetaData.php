<?php
// created: 2017-09-18 04:07:10
$dictionary["lien_liens_lops_contacts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'lien_liens_lops_contacts' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'LIEN_Liens_LOPs',
      'rhs_table' => 'lien_liens_lops',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'lien_liens_lops_contacts_c',
      'join_key_lhs' => 'lien_liens_lops_contactscontacts_ida',
      'join_key_rhs' => 'lien_liens_lops_contactslien_liens_lops_idb',
    ),
  ),
  'table' => 'lien_liens_lops_contacts_c',
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
      'name' => 'lien_liens_lops_contactscontacts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'lien_liens_lops_contactslien_liens_lops_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'lien_liens_lops_contactsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'lien_liens_lops_contacts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'lien_liens_lops_contactscontacts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'lien_liens_lops_contacts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'lien_liens_lops_contactslien_liens_lops_idb',
      ),
    ),
  ),
);