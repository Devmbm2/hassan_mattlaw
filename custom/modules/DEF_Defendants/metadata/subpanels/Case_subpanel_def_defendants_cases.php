<?php
// created: 2019-11-07 08:10:08
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'defendant' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID1_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id1_c',
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'policy_type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_POLICY_TYPE',
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
  'policy_limits' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_POLICY_LIMITS',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'defense_attorney_c' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_DEFENSE_ATTORNEY',
    'id' => 'CONTACT_ID4_C',
    'link' => true,
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id4_c',
  ),
  'claim_number' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_CLAIM_NUMBER',
    'width' => '10%',
    'default' => true,
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
    'refresh_page' => true,
    'module' => 'DEF_Defendants',
    'width' => '5%',
    'default' => true,
  ),
);