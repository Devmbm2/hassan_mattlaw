<?php
$dashletData['COST_Client_CostDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'status_id' => 
  array (
    'default' => '',
  ),
  'payee' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['COST_Client_CostDashlet']['columns'] = array (
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'name' => 'document_name',
  ),
  'invoice_number' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVOICE_NUMBER',
    'width' => '10%',
    'default' => true,
    'name' => 'invoice_number',
  ),
  'payee' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PAYEE',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'payee',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
    'name' => 'status',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
    'name' => 'date_entered',
  ),
  'total_amount' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'total_amount',
  ),
  'cost_client_cost_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
    'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
    'width' => '10%',
    'default' => false,
    'name' => 'cost_client_cost_cases_name',
  ),
  'check_number' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CHECK_NUMBER',
    'width' => '10%',
    'default' => false,
    'name' => 'check_number',
  ),
  'paid_date' => 
  array (
    'type' => 'date',
    'label' => 'LBL_PAID_DATE',
    'width' => '10%',
    'default' => false,
    'name' => 'paid_date',
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => false,
    'name' => 'uploadfile',
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => false,
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => false,
    'name' => 'type',
  ),
);
