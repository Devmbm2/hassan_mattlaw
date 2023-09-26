<?php
$module_name = 'MDOC_Incoming_Bills';
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
        'width' => '10%',
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'running_summary_updated_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_RUNNING_SUMMARY_UPDATED',
        'width' => '10%',
        'name' => 'running_summary_updated_c',
      ),
      'medb_medical_bills_mdoc_incoming_bills_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
        'id' => 'MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1MEDB_MEDICAL_BILLS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'medb_medical_bills_mdoc_incoming_bills_1_name',
      ),
      'client_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CLIENT',
        'width' => '10%',
        'link' => true,
        'id' => 'CONTACT_ID_C',
        'name' => 'client_c',
      ),
    ),
    'advanced_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'running_summary_updated_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_RUNNING_SUMMARY_UPDATED',
        'width' => '10%',
        'name' => 'running_summary_updated_c',
      ),
      'client_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CLIENT',
        'width' => '10%',
        'link' => true,
        'id' => 'CONTACT_ID_C',
        'name' => 'client_c',
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
