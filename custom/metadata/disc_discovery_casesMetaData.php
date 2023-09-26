<?php
// created: 2017-06-13 13:49:07
$dictionary["disc_discovery_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'disc_discovery_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'DISC_Discovery',
      'rhs_table' => 'disc_discovery',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'disc_discovery_cases_c',
      'join_key_lhs' => 'disc_discovery_casescases_ida',
      'join_key_rhs' => 'disc_discovery_casesdisc_discovery_idb',
    ),
  ),
  'table' => 'disc_discovery_cases_c',
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
      'name' => 'disc_discovery_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'disc_discovery_casesdisc_discovery_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'disc_discovery_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'disc_discovery_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'disc_discovery_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'disc_discovery_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'disc_discovery_casesdisc_discovery_idb',
      ),
    ),
  ),
);