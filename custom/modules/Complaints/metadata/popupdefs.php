<?php
$popupMeta = array (
    'moduleMain' => 'Complaint',
    'varName' => 'COMPLAINT',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'complaints.name',
  'type' => 'complaints.type',
  'status' => 'complaints.status',
  'assigned_user_name' => 'complaints.assigned_user_name',
  'suggestion_box' => 'complaints.suggestion_box',
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
),
);
