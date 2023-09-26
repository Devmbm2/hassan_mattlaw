<?php
$module_name = 'MEDR_Medical_Records';
$OBJECT_NAME = 'MEDR_MEDICAL_RECORDS';
$listViewDefs [$module_name] = 
array (
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'sortable' => false,
    'default' => true,
  ),
  'CONTACT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'CONTACT_ID',
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
  'NAME_OF_DOCTOR' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_NAME_OF_DOCTOR',
    'width' => '10%',
    'default' => true,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'link' => true,
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'MEDR_Medical_Records',
    ),
  ),
  'STATUS_ID' => 
  array (
    'type' => 'enum',
    'default' => true,
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
  ),
  'MED_SUMMARY_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_MED_SUMMARY_STATUS',
    'width' => '10%',
  ),
  'NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'name',
    'width' => '10%',
    'default' => false,
  ),
  'RANGE_OF_RECORDS_REQUESTED_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_RANGE_OF_RECORDS_REQUESTED',
    'width' => '10%',
  ),
);
