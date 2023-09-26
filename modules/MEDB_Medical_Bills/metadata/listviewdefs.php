<?php
$module_name = 'MEDB_Medical_Bills';
$OBJECT_NAME = 'MEDB_MEDICAL_BILLS';
$listViewDefs [$module_name] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
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
  'MEDICAL_PROVIDER' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_MEDICAL_PROVIDER',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'LOP_LIEN' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_LOP_LIEN',
    'width' => '10%',
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
  'STATUS_ID' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
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
  'REDUCTION_AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_REDUCTION_AMOUNT',
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
);
?>
