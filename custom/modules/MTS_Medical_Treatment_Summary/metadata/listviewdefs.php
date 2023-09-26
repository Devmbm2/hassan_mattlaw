<?php
$module_name = 'MTS_Medical_Treatment_Summary';
$OBJECT_NAME = 'MTS_MEDICAL_TREATMENT_SUMMARY';
$listViewDefs [$module_name] = 
array (
  'TREATMENT_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_TREATMENT_DATE',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'SUMMARY_TITLE_LIST' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_SUMMARY_TITLE_LIST',
    'width' => '10%',
    'default' => true,
  ),
  'MEDICAL_PROVIDER_ORGANIZATION' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_MEDICAL_PROVIDER_ORGANIZATION',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'MEDICAL_PROVIDER_PERSON' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_MEDICAL_PROVIDER_PERSON',
    'id' => 'CONTACT_ID_C',
    'link' => true,
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
      'module' => 'MTS_Medical_Treatment_Summary',
    ),
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'TREATMENT_DESCRIPTION_SUMMARY' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_TREATMENT_DESCRIPTION_SUMMARY',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'TREATMENT_WORK_PRODUCT_NOTE' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_TREATMENT_WORK_PRODUCT_NOTE',
    'sortable' => false,
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
  'SYMPTOM_1' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_1',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_2' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_2',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_2' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_2',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10%',
    'default' => false,
  ),
  'MISSING_RECORD_WE_NEED_TO_GET' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MISSING_RECORD_WE_NEED_TO_GET',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_3' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_3',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_3' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_3',
    'width' => '10%',
    'default' => false,
  ),
  'CPT_CODES_TREATMENT' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_CPT_CODES_TREATMENT',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_OTHER' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_OTHER',
    'width' => '10%',
    'default' => false,
  ),
  'ICD_CODES' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_ICD_CODES',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_OTHER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SYMPTOM_OTHER',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_4' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_4',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_4' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_4',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_5' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_5',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_5' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_5',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_6' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_6',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_6' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_6',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_7' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_7',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_7' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_7',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_8' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_8',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_8' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_8',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_9' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_9',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCALE_9' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCALE_9',
    'width' => '10%',
    'default' => false,
  ),
  'SYMPTOM_10' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SYMPTOM_10',
    'width' => '10%',
    'default' => false,
  ),
  'PAIN_SCLAE_10' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_PAIN_SCLAE_10',
    'width' => '10%',
    'default' => false,
  ),
);
