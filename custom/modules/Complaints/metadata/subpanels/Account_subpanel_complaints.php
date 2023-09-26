<?php
// created: 2019-12-27 23:40:19
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'default' => true,
  ),
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
  'account_complaint_role' => 
  array (
    'name' => 'account_complaint_role',
    'vname' => 'LBL_ACCOUNT_COMPLAINT_ROLE',
    'width' => '10%',
    'sortable' => true,
    'default' => true,
  ),
  'priority' => 
  array (
    'vname' => 'LBL_LIST_PRIORITY',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditAccountComplaintButton',
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
  'complaint_account_fields' => 
  array (
    'usage' => 'query_only',
  ),
  'complaint_account_id' => 
  array (
    'usage' => 'query_only',
  ),
);