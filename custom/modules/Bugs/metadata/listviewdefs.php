<?php
$listViewDefs ['Bugs'] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_SUBJECT',
    'default' => true,
    'link' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'PRIORITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PRIORITY',
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => true,
  ),
  'WORK_LOG' => 
  array (
    'type' => 'text',
    'label' => 'LBL_WORK_LOG',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_TYPE',
    'default' => false,
  ),
  'BUG_NUMBER' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_NUMBER',
    'link' => true,
    'default' => false,
  ),
  'FIXED_IN_RELEASE_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_FIXED_IN_RELEASE',
    'default' => false,
    'related_fields' => 
    array (
      0 => 'fixed_in_release',
    ),
    'module' => 'Releases',
    'id' => 'FIXED_IN_RELEASE',
  ),
  'RELEASE_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_FOUND_IN_RELEASE',
    'default' => false,
    'related_fields' => 
    array (
      0 => 'found_in_release',
    ),
    'module' => 'Releases',
    'id' => 'FOUND_IN_RELEASE',
  ),
);
;
?>
