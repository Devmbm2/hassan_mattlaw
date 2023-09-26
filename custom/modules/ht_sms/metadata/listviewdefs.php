<?php
$module_name = 'ht_sms';
$listViewDefs [$module_name] = 
array (
  'PARENT_NAME' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'label' => 'LBL_FLEX_RELATE',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'FROM_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FROM_NUMBER',
    'width' => '20%',
    'default' => true,
  ),
  'SENT_RECEIVED' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_RECEIVED',
    'width' => '10%',
    'default' => true,
  ),
  'MESSAGE_STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MESSAGE_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'TO_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TO_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'FILENAME' => 
  array (
    'label' => 'LBL_FILENAME',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'ht_sms',
    ),
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
