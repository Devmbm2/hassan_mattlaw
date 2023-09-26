<?php
// created: 2019-03-28 11:01:15
$subpanel_layout['list_fields'] = array (
  'date_start' => 
  array (
    'type' => 'datetimecombo',
    'vname' => 'LBL_DATE',
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
  'case_event_c' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_CASE_EVENT',
    'id' => 'ACASE_ID_C',
    'link' => true,
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'acase_id_c',
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'view_event_on_calendar' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_VIEW_EVENT_ON_CALENDAR',
    'width' => '10%',
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
  'location_address_city_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_LOCATION_ADDRESS_CITY',
    'width' => '10%',
  ),
  'travel_start_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_TRAVEL_START',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'FP_events',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'FP_events',
    'width' => '5%',
    'default' => true,
  ),
);