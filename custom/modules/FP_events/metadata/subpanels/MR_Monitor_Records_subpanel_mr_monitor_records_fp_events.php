<?php
// created: 2020-04-09 07:00:50
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'date_start' => 
  array (
    'type' => 'datetimecombo',
    'vname' => 'LBL_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'cases_fp_events_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
    'id' => 'CASES_FP_EVENTS_1CASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'cases_fp_events_1cases_ida',
  ),
  'type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'multiple_assigned_users' => 
  array (
    'type' => 'multienum',
    'vname' => 'LBL_MULTIPLE_ASSIGNED_USERS',
    'width' => '10%',
    'default' => true,
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