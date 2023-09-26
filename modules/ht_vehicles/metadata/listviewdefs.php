<?php
$module_name = 'ht_vehicles';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'VIN_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VIN_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'VEHICLE_TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_VEHICLE_TYPE',
    'width' => '10%',
  ),
  'VEHICLE_MAKE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VEHICLE_MAKE',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'VEHICLE_COLOR' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VEHICLE_COLOR',
    'width' => '10%',
    'default' => false,
  ),
  'VEHICLE_YEAR' => 
  array (
    'type' => 'int',
    'label' => 'LBL_VEHICLE_YEAR',
    'width' => '10%',
    'default' => false,
  ),
  'VEHICLE_LICENSE_PLATE_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VEHICLE_LICENSE_PLATE_NUMBER',
    'width' => '10%',
    'default' => false,
  ),
);
