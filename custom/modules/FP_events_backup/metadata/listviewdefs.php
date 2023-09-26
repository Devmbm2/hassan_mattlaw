<?php
$module_name = 'FP_events';
$listViewDefs [$module_name] = 
array (
  'DATE_START' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_DATE',
    'width' => '15%',
    'default' => true,
    'link' => true,
  ),
  'MULTIPLE_ASSIGNED_USERS' => 
  array (
    'type' => 'multienum',
    'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
    'width' => '10%',
    'default' => true,
  ),
/*   'PARENT_NAME' => 
  array (
    'type' => 'parent',
    'default' => true,
    'studio' => 'visible',
    'label' => 'Case/Client',
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
  ), */
  'CASE_CLIENT' => 
  array (
    'width' => '20%',
    'label' => 'LBL_CASE_CLIENT',
    'default' => true,
    'link' => true,
  ),  
  'NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'VIEW_EVENT_ON_CALENDAR' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_VIEW_EVENT_ON_CALENDAR',
    'width' => '10%',
  ),
  'TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'LOCATION_ADDRESS_CITY_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_LOCATION_ADDRESS_CITY',
    'width' => '10%',
  ),
  'TRAVEL_START_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_TRAVEL_START',
    'width' => '10%',
  ),
);
