<?php
$module_name = 'ht_login_tracker';
$listViewDefs [$module_name] = 
array (
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'ht_login_tracker',
    'id' => 'id',
    'default' => true,
  ),
  'IP_ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
  'BROWSER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_BROWSER',
    'width' => '10%',
    'default' => true,
  ),
  'OPERATING_SYSTEM' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_OPERATING_SYSTEM',
    'width' => '10%',
    'default' => true,
  ),
  'DEVICE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DEVICE',
    'width' => '10%',
    'default' => true,
  ),
  'LOGIN_TIMESTAMP' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LOGIN_TIMESTAMP',
    'width' => '10%',
    'default' => true,
  ),
  'LOGOUT_TIMESTAMP' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LOGOUT_TIMESTAMP',
    'width' => '10%',
    'default' => true,
  ),
  'LOGIN_STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LOGIN_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
);
;
?>
