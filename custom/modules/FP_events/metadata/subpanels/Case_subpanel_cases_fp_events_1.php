<?php
// created: 2019-11-25 23:37:03
$subpanel_layout['list_fields'] = array (
  'date_start' => 
  array (
    'type' => 'datetimecombo',
    'vname' => 'LBL_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'location_name' => 
  array (
    'type' => 'relate',
    'default' => true,
    'vname' => 'LBL_LOCATION_NAME',
    'id' => 'LOCATION_ID',
    'link' => true,
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'location_id',
  ),
  'primary_address_street' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_PRIMARY_ADDRESS_STREET',
    'width' => '10%',
    'default' => true,
  ),
  'location_address_city_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_LOCATION_ADDRESS_CITY',
    'width' => '10%',
  ),
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'duration_list' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_DURATION_LIST',
    'width' => '10%',
    'default' => true,
  ),
  'multiple_assigned_users' => 
  array (
    'type' => 'multienum',
    'vname' => 'LBL_MULTIPLE_ASSIGNED_USERS',
    'width' => '10%',
    'default' => true,
  ),
);