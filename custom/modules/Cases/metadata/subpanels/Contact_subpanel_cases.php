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
  'case_contact_fields' => 
  array (
    'usage' => 'query_only',
  ),
  'case_role_id' => 
  array (
    'usage' => 'query_only',
  ),
    'contact_role' => 
  array (
    'name' => 'contact_role',
    'vname' => 'LBL_CASE_CONTACT_ROLE',
    'width' => '10%',
    'sortable' => true,
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
  'total_case_length_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'vname' => 'LBL_TOTAL_CASE_LENGTH',
    'width' => '10%',
  ),
  'mdp_estimated_case_value_c' => 
  array (
    'type' => 'currency',
    'default' => true,
    'vname' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
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
    'widget_class' => 'SubPanelEditContactCaseButton',
    'module' => 'Cases',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Cases',
    'width' => '5%',
    'default' => true,
  ),

);