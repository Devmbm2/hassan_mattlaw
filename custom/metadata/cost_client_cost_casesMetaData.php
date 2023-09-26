<?php
// created: 2017-06-13 17:19:09
$dictionary["cost_client_cost_cases"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'cost_client_cost_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'COST_Client_Cost',
      'rhs_table' => 'cost_client_cost',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'cost_client_cost_cases_c',
      'join_key_lhs' => 'cost_client_cost_casescases_ida',
      'join_key_rhs' => 'cost_client_cost_casescost_client_cost_idb',
    ),
  ),
  'table' => 'cost_client_cost_cases_c',
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
      'name' => 'cost_client_cost_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'cost_client_cost_casescost_client_cost_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'cost_client_cost_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'cost_client_cost_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'cost_client_cost_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'cost_client_cost_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'cost_client_cost_casescost_client_cost_idb',
      ),
    ),
  ),
);