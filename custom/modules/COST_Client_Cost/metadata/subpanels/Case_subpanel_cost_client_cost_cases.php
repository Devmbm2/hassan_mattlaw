<?php
// created: 2021-03-10 11:14:33
$subpanel_layout['list_fields'] = array (
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
  ),
  'document_name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'parent_name' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'vname' => 'LBL_FLEX_RELATE',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => 'parent_id',
  ),
  'uploadfile' => 
  array (
    'name' => 'uploadfile',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '20%',
    'module' => 'COST_Client_Cost',
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'COST_Client_Cost',
    ),
    'default' => true,
  ),
  'total_amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '5%',
    'default' => true,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'invoice_number' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_INVOICE_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'COST_Client_Cost',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'refresh_page' => true,
    'module' => 'COST_Client_Cost',
    'width' => '5%',
    'default' => true,
  ),
  'parent_type' => 
  array (
    'usage' => 'query_only',
  ),
);