<?php
// created: 2020-04-09 00:19:18
$dictionary["mr_monitor_records_def_client_insurance"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'mr_monitor_records_def_client_insurance' => 
    array (
      'lhs_module' => 'MR_Monitor_Records',
      'lhs_table' => 'mr_monitor_records',
      'lhs_key' => 'id',
      'rhs_module' => 'DEF_Client_Insurance',
      'rhs_table' => 'def_client_insurance',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mr_monitor_records_def_client_insurance_c',
      'join_key_lhs' => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
      'join_key_rhs' => 'mr_monitor_records_def_client_insurancedef_client_insurance_idb',
    ),
  ),
  'table' => 'mr_monitor_records_def_client_insurance_c',
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
      'name' => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mr_monitor_records_def_client_insurancedef_client_insurance_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mr_monitor_records_def_client_insurancespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mr_monitor_records_def_client_insurance_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mr_monitor_records_def_client_insurancemr_monitor_records_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mr_monitor_records_def_client_insurance_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mr_monitor_records_def_client_insurancedef_client_insurance_idb',
      ),
    ),
  ),
);