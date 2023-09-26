<?php
// created: 2020-10-12 14:58:08
$searchFields['DEF_Defendants'] = array (
  'name' => 
  array (
    'query_type' => 'default',
  ),
  'current_user_only' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'assigned_user_id',
    ),
    'my_items' => true,
    'vname' => 'LBL_CURRENT_USER_FILTER',
    'type' => 'bool',
  ),
  'assigned_user_id' => 
  array (
    'query_type' => 'default',
  ),
  'range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'assigned_lawyer_cases' => 
  array (
    'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT def_defendants.id
					FROM `def_defendants`
					INNER JOIN def_defendants_cases_c ON (def_defendants_cases_c.deleted = 0 AND def_defendants_cases_c.def_defendants_casesdef_defendants_ida = def_defendants.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = def_defendants_cases_c.def_defendants_casescases_idb)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE def_defendants.deleted = 0 AND CONCAT_WS(" ", users.first_name, users.last_name) LIKE ',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_status' => 
  array (
    'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT def_defendants.id
					FROM `def_defendants`
					INNER JOIN def_defendants_cases_c ON (def_defendants_cases_c.deleted = 0 AND def_defendants_cases_c.def_defendants_casesdef_defendants_ida = def_defendants.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = def_defendants_cases_c.def_defendants_casescases_idb)
					WHERE def_defendants.deleted = 0 AND cases.status LIKE',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);