<?php
// created: 2020-04-09 06:47:05
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'insurance_company' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_INSURANCE_COMPANY',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'claim_number' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_CLAIM_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'date_of_incident' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_OF_INCIDENT',
    'width' => '10%',
    'default' => true,
  ),
  'acase_name' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'link' => true,
    'vname' => 'LBL_ACASE_NAME',
    'id' => 'ACASE_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'acase_id',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'DEF_Defendants',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'DEF_Defendants',
    'width' => '5%',
    'default' => true,
  ),
);