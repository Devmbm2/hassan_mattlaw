<?php
$module_name = 'MEDB_Medical_Bills';
$OBJECT_NAME = 'MEDB_MEDICAL_BILLS';
$listViewDefs [$module_name] = 
array (
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'MEDB_MEDICAL_BILLS_CONTACTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'MEDB_MEDICAL_BILLS_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_RUNB_NAME',
    'link' => true,
    'default' => true,
  ),
  'MEDICAL_PROVIDER' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNT_ID_C',
    'width' => '10%',
    'default' => true,
  ),
  'TOTAL_CHARGES' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'BALANCE' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_BALANCE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'REDUCTION_AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_REDUCTION_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ADJUSTMENTS' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_ADJUSTMENTS',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'CLIENT_PAID' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_CLIENT_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'MEDICARE_PAID' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_MEDICARE_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'MEDICAID_PAID' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_MEDICAID_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'PIP_PAID' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_PIP_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'REDUCTION_APPROVED_BY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_REDUCTION_APPROVED_BY',
    'width' => '10%',
    'default' => false,
  ),
  'TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'HEALTH_INSURANCE_PAID' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_HEALTH_INSURANCE_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
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
  'WRITE_OFFS_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_WRITE_OFFS',
    'currency_format' => true,
    'width' => '10%',
  ),
  'INTEREST_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_INTEREST',
    'currency_format' => true,
    'width' => '10%',
  ),
  'MEDICARE_TYPE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_MEDICARE_TYPE',
    'width' => '10%',
  ),
  'COPY_CHARGES' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_COPY_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
);
