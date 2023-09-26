<?php
$module_name = 'ht_sms';
$listViewDefs [$module_name] = 
array (
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
    'width' => '10%',
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
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
);
;
?>
