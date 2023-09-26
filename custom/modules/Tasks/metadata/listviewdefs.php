<?php
$listViewDefs ['Tasks'] = 
array (
  'DATE_DUE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_DUE_DATE',
    'link' => true,
    'default' => true,
    'sortable' => false,
  ),
  'PARENT_NAME' => 
  array (
    'type' => 'relate',
    'width' => '20%',
    'label' => 'LBL_LIST_RELATED_TO',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'link' => false,
    'default' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
  ),
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'sortable' => false,
  ),
  'CASE_STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CASE_STATUS',
    'link' => false,
    'default' => true,
    'sortable' => false,
  ),
  'CASE_ASSISTANT' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CASE_ASSISTANT',
    'link' => false,
    'default' => true,
    'sortable' => false,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'link' => false,
    'default' => true,
    'sortable' => false,
  ),
  'NO_OF_DAYS' => 
  array (
    'type' => 'text',
    'label' => 'LBL_NO_OF_DAYS',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'TEAM_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TEAM',
    'id' => 'SECURITYGROUP_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'DATE_START' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_START_DATE',
    'link' => false,
    'default' => false,
    'sortable' => false,
  ),
  'SET_COMPLETE' => 
  array (
    'width' => '1%',
    'label' => 'LBL_LIST_CLOSE',
    'link' => true,
    'sortable' => false,
    'default' => false,
    'related_fields' => 
    array (
      0 => 'status',
    ),
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
    'sortable' => false,
  ),
  'TIME_SPENT_C' => 
  array (
    'type' => 'decimal',
    'default' => false,
    'label' => 'LBL_TIME_SPENT',
    'width' => '10%',
    'sortable' => false,
  ),
  'TIME_DUE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_DUE_TIME',
    'sortable' => false,
    'link' => false,
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
    'sortable' => false,
  ),
);
