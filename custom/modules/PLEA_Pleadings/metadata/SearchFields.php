<?php
// created: 2022-09-02 13:19:44
$searchFields['PLEA_Pleadings'] = array (
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
    'subquery' => 'SELECT plea_pleadings.id
					FROM `plea_pleadings`
					INNER JOIN plea_pleadings_cases_c ON (plea_pleadings_cases_c.deleted = 0 AND plea_pleadings_cases_c.plea_pleadings_casesplea_pleadings_idb = plea_pleadings.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = plea_pleadings_cases_c.plea_pleadings_casescases_ida)
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
    'subquery' => 'SELECT plea_pleadings.id
					FROM `plea_pleadings`
					INNER JOIN plea_pleadings_cases_c ON (plea_pleadings_cases_c.deleted = 0 AND plea_pleadings_cases_c.plea_pleadings_casesplea_pleadings_idb = plea_pleadings.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = plea_pleadings_cases_c.plea_pleadings_casescases_ida)
					WHERE plea_pleadings.deleted = 0 AND cases.status IN (\'{0}\') ',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);