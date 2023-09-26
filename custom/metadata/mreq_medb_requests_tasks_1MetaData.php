<?php
// created: 2018-10-02 16:16:19
$dictionary["mreq_medb_requests_tasks_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'mreq_medb_requests_tasks_1' => 
    array (
      'lhs_module' => 'MREQ_MEDB_Requests',
      'lhs_table' => 'mreq_medb_requests',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mreq_medb_requests_tasks_1_c',
      'join_key_lhs' => 'mreq_medb_requests_tasks_1mreq_medb_requests_ida',
      'join_key_rhs' => 'mreq_medb_requests_tasks_1tasks_idb',
    ),
  ),
  'table' => 'mreq_medb_requests_tasks_1_c',
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
      'name' => 'mreq_medb_requests_tasks_1mreq_medb_requests_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mreq_medb_requests_tasks_1tasks_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mreq_medb_requests_tasks_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mreq_medb_requests_tasks_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mreq_medb_requests_tasks_1mreq_medb_requests_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mreq_medb_requests_tasks_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'mreq_medb_requests_tasks_1tasks_idb',
      ),
    ),
  ),
);
