<?php
$dashletData['MEDB_Medical_BillsDashlet']['searchFields'] = array (
  'summary_status_c' => 
  array (
    'default' => '',
  ),
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['MEDB_Medical_BillsDashlet']['columns'] = array (
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'name' => 'document_name',
  ),
  'medical_provider' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_MEDICAL_PROVIDER',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'medical_provider',
  ),
  'total_charges' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'total_charges',
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => true,
    'name' => 'uploadfile',
  ),
  'balance' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_BALANCE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'balance',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
    'name' => 'description',
  ),
  'client_paid' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_CLIENT_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'client_paid',
  ),
  'copy_charges' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_COPY_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'copy_charges',
  ),
  'health_insurance_paid' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_HEALTH_INSURANCE_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'health_insurance_paid',
  ),
  'status' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => false,
    'name' => 'status',
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => false,
    'name' => 'status_id',
  ),
  'medicaid_paid' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_MEDICAID_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'medicaid_paid',
  ),
  'pip_paid' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_PIP_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'pip_paid',
  ),
  'medicare_paid' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_MEDICARE_PAID',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'medicare_paid',
  ),
  'reduction_amount' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_REDUCTION_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => false,
    'name' => 'reduction_amount',
  ),
  'medb_medical_bills_contacts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'MEDB_MEDICAL_BILLS_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => false,
    'name' => 'medb_medical_bills_contacts_name',
  ),
  'summary_status_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SUMMARY_STATUS',
    'width' => '10%',
    'name' => 'summary_status_c',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
    'name' => 'date_entered',
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
);
