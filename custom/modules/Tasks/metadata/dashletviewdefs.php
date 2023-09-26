<?php
$dashletData['TasksDashlet']['searchFields'] = array (
  'type_of_todo_c' => 
  array (
    'default' => '',
  ),
  'name' => 
  array (
    'default' => '',
  ),
  'priority' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_due' => 
  array (
    'default' => '',
  ),
  'team_c' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['TasksDashlet']['columns'] = array (
  'date_due' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DUE_DATE',
    'name' => 'date_due',
    'default' => true,
	'defaultOrderColumn' => array('sortOrder' => 'ASC')
  ),
    'parent_name' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_RELATED_TO',
    'sortable' => false,
    'dynamic_module' => 'PARENT_TYPE',
    'link' => true,
    'id' => 'PARENT_ID',
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'default' => true,
    'name' => 'parent_name',
  ),
  
  'name' => 
  array (
    'width' => '10%',
    'label' => 'LBL_SUBJECT',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'status' => 
  array (
    'width' => '8%',
    'label' => 'LBL_STATUS',
    'default' => true,
    'name' => 'status',
  ),
   'type_of_todo_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE_OF_TODO',
    'width' => '10%',
  ),
    'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
    'name' => 'description',
  ), 
  'assigned_lawyer_cases' => 
  array (
	'name' => 'assigned_lawyer_cases',
	'label' => 'LBL_ASSIGNED_LAWYER_CASES',
	'type' => 'enum',
	'source' => 'non-db',
	'width' => '10%',
	'options' => 'assigned_lawyer_cases_list',
    'default' => true,
  ),
);
