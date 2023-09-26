<?php
$module_name = 'MEDR_Medical_Records';
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
      'status_id' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'name' => 'status_id',
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'med_summary_status_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MED_SUMMARY_STATUS',
        'width' => '10%',
        'name' => 'med_summary_status_c',
      ),
      'medical_record_summary_done_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_MEDICAL_RECORD_SUMMARY_DONE',
        'width' => '10%',
        'name' => 'medical_record_summary_done_c',
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
      'status_id' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'name' => 'status_id',
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'case_type_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type_c',
      ),
      'med_summary_status_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MED_SUMMARY_STATUS',
        'width' => '10%',
        'name' => 'med_summary_status_c',
      ),
      'medical_record_summary_done_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_MEDICAL_RECORD_SUMMARY_DONE',
        'width' => '10%',
        'name' => 'medical_record_summary_done_c',
      ),
      'range_of_records_requested_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_RANGE_OF_RECORDS_REQUESTED',
        'width' => '10%',
        'name' => 'range_of_records_requested_c',
      ),
      'contact_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
        'id' => 'CONTACT_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'contact_name',
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
