<?php
// created: 2020-04-09 03:56:34
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '40%',
    'default' => true,
  ),
  'status' => 
  array (
    'vname' => 'LBL_LIST_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'date_of_incident_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_INCIDENT',
    'width' => '10%',
  ),
  'total_complaint_length_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_TOTAL_COMPLAINT_LENGTH',
    'width' => '10%',
  ),
  'assigned_user_name' => 
  array (
    'name' => 'assigned_user_name',
    'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'assigned_user_id',
    'target_module' => 'Employees',
    'width' => '10%',
    'default' => true,
  ),
  'complaint_insurance_summary_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_COMPLAINT_INSURANCE_SUMMARY',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Complaints',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Complaints',
    'width' => '5%',
    'default' => true,
  ),
);