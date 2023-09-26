<?php
$module_name = 'ht_timesheet';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'LOGIN' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LOGIN',
    'width' => '10%',
    'default' => true,
  ),
  'LOGOUT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_LOGOUT',
    'width' => '10%',
    'default' => true,
  ),
  'IDLE_TIME' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_IDLE_TIME',
    'width' => '10%',
    'default' => true,
  ),
  'WORK_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_WORK_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'DAY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DAY',
    'width' => '10%',
    'default' => true,
  ),
  'LOGGED_HOURS' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_LOGGED_HOURS',
    'width' => '10%',
    'default' => true,
  ),
  'IP_ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
  'OVERTIME_HOURS' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_OVERTIME_HOURS',
    'width' => '10%',
    'default' => false,
  ),
  'REGULAR_HOURS' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_REGULAR_HOURS',
    'width' => '10%',
    'default' => false,
  ),
  'END_TIME' => 
  array (
    'type' => 'time',
    'label' => 'LBL_END_TIME',
    'width' => '10%',
    'default' => false,
  ),
  'START_TIME' => 
  array (
    'type' => 'time',
    'label' => 'LBL_START_TIME',
    'width' => '10%',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
