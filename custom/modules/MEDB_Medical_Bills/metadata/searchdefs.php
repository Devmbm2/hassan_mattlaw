<?php
$module_name = 'MEDB_Medical_Bills';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
      ),
    ),
    'advanced_search' => 
    array (
      'modified_user_id' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'modified_user_id',
      ),
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'category_id' => 
      array (
        'name' => 'category_id',
        'default' => true,
        'width' => '10%',
      ),
      'subcategory_id' => 
      array (
        'name' => 'subcategory_id',
        'default' => true,
        'width' => '10%',
      ),
      'active_date' => 
      array (
        'name' => 'active_date',
        'default' => true,
        'width' => '10%',
      ),
      'adjustments' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_ADJUSTMENTS',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'adjustments',
      ),
      'client_paid' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_CLIENT_PAID',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'client_paid',
      ),
      'medb_medical_bills_contacts_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
        'id' => 'MEDB_MEDICAL_BILLS_CONTACTSCONTACTS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'medb_medical_bills_contacts_name',
      ),
      'amount_jury_sees' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_AMOUNT_JURY_SEES',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'amount_jury_sees',
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
      'copy_charges' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_COPY_CHARGES',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'copy_charges',
      ),
      'health_insurance_paid' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_HEALTH_INSURANCE_PAID',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'health_insurance_paid',
      ),
      'exp_date' => 
      array (
        'name' => 'exp_date',
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
