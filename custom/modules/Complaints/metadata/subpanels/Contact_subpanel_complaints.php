<?php
// created: 2019-11-14 23:29:50
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_SUBJECT',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
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
  'mdp_estimated_complaint_value_c' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_MDP_ESTIMATED_COMPLAINT_VALUE',
    'currency_format' => true,
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
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditContactComplaintButton',
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