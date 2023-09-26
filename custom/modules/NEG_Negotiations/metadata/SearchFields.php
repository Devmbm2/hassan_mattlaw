<?php
// created: 2020-04-07 08:46:01
$searchFields['NEG_Negotiations'] = array (
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
    'subquery' => "SELECT neg_negotiations.id
					FROM `neg_negotiations`
					INNER JOIN neg_negotiations_cases_c ON (neg_negotiations_cases_c.deleted = 0 AND neg_negotiations_cases_c.neg_negotiations_casesneg_negotiations_idb= neg_negotiations.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = neg_negotiations_cases_c.neg_negotiations_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE CONCAT_WS(' ', users.first_name, users.last_name) IN ('{0}') ",
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'case_status' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => "SELECT neg_negotiations.id
					FROM `neg_negotiations`
					INNER JOIN neg_negotiations_cases_c ON (neg_negotiations_cases_c.deleted = 0 AND neg_negotiations_cases_c.neg_negotiations_casesneg_negotiations_idb= neg_negotiations.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = neg_negotiations_cases_c.neg_negotiations_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE neg_negotiations.deleted = 0 AND cases.status IN ('{0}') ",
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
);