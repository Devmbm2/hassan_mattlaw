<?php
$listViewDefs ['Complaints'] = 
array (
  'NAME' => 
  array (
    'width' => '80%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'sortable' => false,
  ),
  'CASE_NAME_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_NAME',
    'id' => 'ACASE_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
    'sortable' => false,
  ),
  'DATE_OF_INCIDENT_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_INCIDENT',
    'width' => '10%',
    'sortable' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'link' => false,
    'sortable' => false,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'default' => false,
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'sortable' => false,
  ),
  'JUDGE_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_JUDGE',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'sortable' => false,
  ),
);
