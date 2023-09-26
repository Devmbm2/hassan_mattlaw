<?php
// created: 2020-03-10 00:25:04
$searchFields['FP_events'] = array (
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
  'range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_start' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_end' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'multiple_assigned_users' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT fp_events.id
					FROM fp_events
					WHERE fp_events.deleted= 0 AND fp_events.multiple_assigned_users LIKE "%{0}%"',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'assigned_lawyer_cases' => 
  array (
    'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT fp_events.id
					FROM `fp_events`
					INNER JOIN cases_fp_events_1_c ON (cases_fp_events_1_c.deleted = 0 AND cases_fp_events_1_c.cases_fp_events_1fp_events_idb = fp_events.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = cases_fp_events_1_c.cases_fp_events_1cases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE fp_events.deleted = 0 AND CONCAT_WS(" ", users.first_name, users.last_name) LIKE',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_status' => 
  array (
    'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT fp_events.id
					FROM `fp_events`
					INNER JOIN cases_fp_events_1_c ON (cases_fp_events_1_c.deleted = 0 AND cases_fp_events_1_c.cases_fp_events_1fp_events_idb = fp_events.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = cases_fp_events_1_c.cases_fp_events_1cases_ida)
					WHERE fp_events.deleted = 0 AND cases.status LIKE',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);