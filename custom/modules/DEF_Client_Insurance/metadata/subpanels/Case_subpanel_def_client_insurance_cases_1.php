<?php
// created: 2019-11-07 08:14:29
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '30%',
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
    'width' => '25%',
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
  'adjuster' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_ADJUSTER',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id_c',
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
    'module' => 'DEF_Client_Insurance',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'DEF_Client_Insurance',
    'width' => '5%',
    'default' => true,
  ),
);