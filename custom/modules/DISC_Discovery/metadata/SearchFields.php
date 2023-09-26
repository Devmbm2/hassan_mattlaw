<?php
// created: 2022-06-28 16:35:11
$searchFields['DISC_Discovery'] = array (
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
    'subquery' => 'SELECT disc_discovery.id
					FROM `disc_discovery`
					INNER JOIN disc_discovery_cases_c ON (disc_discovery_cases_c.deleted = 0 AND disc_discovery_cases_c.disc_discovery_casesdisc_discovery_idb = disc_discovery.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = disc_discovery_cases_c.disc_discovery_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE CONCAT_WS(\' \', users.first_name, users.last_name) IN (\'{0}\') ',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_status' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT disc_discovery.id
					FROM `disc_discovery`
					INNER JOIN disc_discovery_cases_c ON (disc_discovery_cases_c.deleted = 0 AND disc_discovery_cases_c.disc_discovery_casesdisc_discovery_idb = disc_discovery.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = disc_discovery_cases_c.disc_discovery_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE disc_discovery.deleted = 0 AND cases.status IN (\'{0}\')',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);