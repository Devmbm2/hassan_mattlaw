<?php
// created: 2017-06-06 17:12:58
$dictionary["def_client_insurance_cases_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'def_client_insurance_cases_1' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'DEF_Client_Insurance',
      'rhs_table' => 'def_client_insurance',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'def_client_insurance_cases_1_c',
      'join_key_lhs' => 'def_client_insurance_cases_1cases_ida',
      'join_key_rhs' => 'def_client_insurance_cases_1def_client_insurance_idb',
    ),
  ),
  'table' => 'def_client_insurance_cases_1_c',
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
      'name' => 'def_client_insurance_cases_1cases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'def_client_insurance_cases_1def_client_insurance_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'def_client_insurance_cases_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'def_client_insurance_cases_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'def_client_insurance_cases_1cases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'def_client_insurance_cases_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'def_client_insurance_cases_1def_client_insurance_idb',
      ),
    ),
  ),
);