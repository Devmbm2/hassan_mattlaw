<?php
// created: 2021-03-04 08:13:29
$searchFields['COST_Client_Cost'] = array (
  'document_name' => 
  array (
    'query_type' => 'default',
  ),
  'category_id' => 
  array (
    'query_type' => 'default',
    'options' => 'document_category_dom',
    'template_var' => 'CATEGORY_OPTIONS',
  ),
  'subcategory_id' => 
  array (
    'query_type' => 'default',
    'options' => 'document_subcategory_dom',
    'template_var' => 'SUBCATEGORY_OPTIONS',
  ),
  'active_date' => 
  array (
    'query_type' => 'default',
  ),
  'exp_date' => 
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
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT cost_client_cost.id
					FROM `cost_client_cost`
					INNER JOIN cost_client_cost_cases_c ON (cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = cost_client_cost_cases_c.cost_client_cost_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE cost_client_cost.deleted = 0 AND CONCAT_WS(\' \', users.first_name, users.last_name) IN (\'{0}\')',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_status' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT cost_client_cost.id
					FROM `cost_client_cost`
					INNER JOIN cost_client_cost_cases_c ON (cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = cost_client_cost_cases_c.cost_client_cost_casescases_ida)
					WHERE cost_client_cost.deleted = 0 AND cases.status IN (\'{0}\')',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_type' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT cost_client_cost.id
					FROM `cost_client_cost`
					INNER JOIN cost_client_cost_cases_c ON (cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = cost_client_cost_cases_c.cost_client_cost_casescases_ida)
					WHERE cost_client_cost.deleted = 0 AND cases.type IN (\'{0}\')',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);