<?php
// created: 2018-10-08 07:44:06
$dictionary["mreq_medb_requests_activities_1_meetings"] = array (
  'relationships' => 
  array (
    'mreq_medb_requests_activities_1_meetings' => 
    array (
      'lhs_module' => 'MREQ_MEDB_Requests',
      'lhs_table' => 'mreq_medb_requests',
      'lhs_key' => 'id',
      'rhs_module' => 'Meetings',
      'rhs_table' => 'meetings',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'MREQ_MEDB_Requests',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);