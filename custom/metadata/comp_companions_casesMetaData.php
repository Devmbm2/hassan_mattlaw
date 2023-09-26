<?php
// created: 2017-06-19 18:18:09
$dictionary["comp_companions_cases"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'comp_companions_cases' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'COMP_Companions',
      'rhs_table' => 'comp_companions',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'comp_companions_cases_c',
      'join_key_lhs' => 'comp_companions_casescases_ida',
      'join_key_rhs' => 'comp_companions_casescomp_companions_idb',
    ),
  ),
  'table' => 'comp_companions_cases_c',
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
      'name' => 'comp_companions_casescases_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'comp_companions_casescomp_companions_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'comp_companions_casesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'comp_companions_cases_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'comp_companions_casescases_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'comp_companions_cases_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'comp_companions_casescomp_companions_idb',
      ),
    ),
  ),
);
