<?php
$module_name = 'COST_Client_Cost';
$OBJECT_NAME = 'COST_CLIENT_COST';
$listViewDefs [$module_name] = 
array (
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'COST_CLIENT_COST_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
    'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'PARENT_NAME' => 
  array (
    'type' => 'parent',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_FLEX_RELATE',
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
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'COST_Client_Cost',
    ),
  ),
  'TOTAL_AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'CHECK_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CHECK_NUMBER',
    'width' => '10%',
    'default' => false,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => false,
  ),
  'INVOICE_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVOICE_NUMBER',
    'width' => '10%',
    'default' => false,
  ),
  'PAID_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_PAID_DATE',
    'width' => '10%',
    'default' => false,
  ),
  'CASE_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'label' => 'LBL_CASE_STATUS',
    'width' => '10%',
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MODIFIED_USER',
    'module' => 'Users',
    'id' => 'USERS_ID',
    'default' => false,
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'modified_user_id',
    ),
  ),
);
