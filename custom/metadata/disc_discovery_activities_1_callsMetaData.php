<?php
// created: 2022-08-03 09:43:27
$dictionary["disc_discovery_activities_1_calls"] = array (
  'relationships' => 
  array (
    'disc_discovery_activities_1_calls' => 
    array (
      'lhs_module' => 'DISC_Discovery',
      'lhs_table' => 'disc_discovery',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'DISC_Discovery',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);