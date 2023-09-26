<?php
// created: 2019-06-23 03:37:56
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_RUNB_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'medical_provider' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_MEDICAL_PROVIDER',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'total_charges' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'balance' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_BALANCE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'reduction_amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_REDUCTION_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MEDB_Medical_Bills',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'MEDB_Medical_Bills',
    'width' => '5%',
    'default' => true,
  ),
);