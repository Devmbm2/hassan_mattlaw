<?php
$popupMeta = array (
    'moduleMain' => 'Case',
    'varName' => 'CASE',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'cases.name',
  'type' => 'cases.type',
  'status' => 'cases.status',
  'assigned_user_name' => 'cases.assigned_user_name',
  'suggestion_box' => 'cases.suggestion_box',
),
    'searchInputs' => array (
  0 => 'name',
  1 => 'type',
  2 => 'status',
  3 => 'assigned_user_name',
  4 => 'suggestion_box',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'type' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'name' => 'type',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10%',
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'name' => 'assigned_user_name',
  ),
  'suggestion_box' => 
  array (
    'type' => 'readonly',
    'label' => 'LBL_SUGGESTION_BOX',
    'width' => '10%',
    'name' => 'suggestion_box',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '35%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'STATUS' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
    'name' => 'status',
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
    'name' => 'type',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
  'MDP_ESTIMATED_CASE_VALUE_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'mdp_estimated_case_value_c',
  ),
),
);
