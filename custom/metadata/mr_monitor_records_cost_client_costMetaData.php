<?php
// created: 2020-04-09 00:19:18
$dictionary["mr_monitor_records_cost_client_cost"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mr_monitor_records_cost_client_cost' => 
    array (
      'lhs_module' => 'MR_Monitor_Records',
      'lhs_table' => 'mr_monitor_records',
      'lhs_key' => 'id',
      'rhs_module' => 'COST_Client_Cost',
      'rhs_table' => 'cost_client_cost',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mr_monitor_records_cost_client_cost_c',
      'join_key_lhs' => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
      'join_key_rhs' => 'mr_monitor_records_cost_client_costcost_client_cost_idb',
    ),
  ),
  'table' => 'mr_monitor_records_cost_client_cost_c',
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
      'name' => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mr_monitor_records_cost_client_costcost_client_cost_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mr_monitor_records_cost_client_costspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mr_monitor_records_cost_client_cost_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mr_monitor_records_cost_client_costmr_monitor_records_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mr_monitor_records_cost_client_cost_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mr_monitor_records_cost_client_costcost_client_cost_idb',
      ),
    ),
  ),
);