<?php
$module_name = 'MTS_Medical_Treatment_Summary';
$OBJECT_NAME = 'MTS_MEDICAL_TREATMENT_SUMMARY';
$listViewDefs [$module_name] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'ICD_CODES' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_ICD_CODES',
    'sortable' => false,
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
  'CPT_CODES_TREATMENT' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_CPT_CODES_TREATMENT',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'TREATMENT_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_TREATMENT_DATE',
    'width' => '10%',
    'default' => true,
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
;
?>
