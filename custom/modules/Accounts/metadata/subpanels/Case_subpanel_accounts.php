<?php
// created: 2019-11-25 23:31:25
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_ACCOUNT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'case_role' => 
  array (
    'width' => '10%',
    'sortable' => true,
    'vname' => 'LBL_CASE_ACCOUNT_ROLE',
    'default' => true,
  ),
  'account_type' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'phone_office' => 
  array (
    'vname' => 'LBL_LIST_PHONE',
    'width' => '20%',
    'default' => true,
  ),
  'phone_fax' => 
  array (
    'type' => 'phone',
    'vname' => 'LBL_FAX',
    'width' => '10%',
    'default' => true,
  ),
  'email_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_EMAIL',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditCaseAccountButton',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButtonAccount',
    'width' => '4%',
    'default' => true,
  ),
  'account_case_fields' => 
  array (
    'usage' => 'query_only',
  ),
  'account_case_id' => 
  array (
    'usage' => 'query_only',
  ),
);