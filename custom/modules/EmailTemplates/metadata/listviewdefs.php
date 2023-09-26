<?php
$listViewDefs ['EmailTemplates'] = 
array (
  'NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'width' => '40%',
    'default' => true,
    'sortable' => false,
    'label' => 'LBL_DESCRIPTION',
  ),
  'TYPE' => 
  array (
    'width' => '20%',
    'label' => 'LBL_TYPE',
    'link' => false,
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'width' => '10%',
    'default' => false,
    'label' => 'LBL_DATE_MODIFIED',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
