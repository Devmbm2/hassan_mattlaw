<?php
$popupMeta = array (
    'moduleMain' => 'COST_Client_Cost',
    'varName' => 'COST_Client_Cost',
    'orderBy' => 'cost_client_cost.name',
    'whereClauses' => array (
  'document_name' => 'cost_client_cost.document_name',
  'cost_client_cost_cases_name' => 'cost_client_cost.cost_client_cost_cases_name',
  'payee' => 'cost_client_cost.payee',
  'status' => 'cost_client_cost.status',
  'total_amount' => 'cost_client_cost.total_amount',
),
    'searchInputs' => array (
  3 => 'status',
  4 => 'document_name',
  5 => 'cost_client_cost_cases_name',
  6 => 'payee',
  7 => 'total_amount',
),
    'searchdefs' => array (
  'document_name' => 
  array (
    'name' => 'document_name',
    'width' => '10%',
  ),
  'cost_client_cost_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
    'width' => '10%',
    'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
    'name' => 'cost_client_cost_cases_name',
  ),
  'payee' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PAYEE',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'name' => 'payee',
  ),
  'status' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'name' => 'status',
  ),
  'total_amount' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'total_amount',
  ),
),
    'listviewdefs' => array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'name' => 'document_name',
  ),
  'COST_CLIENT_COST_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
    'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'cost_client_cost_cases_name',
  ),
  'PAYEE' => 
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
  'STATUS' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
    'name' => 'status',
  ),
  'TOTAL_AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'total_amount',
  ),
),
);
