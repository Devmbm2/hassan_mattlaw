<?php
$listViewDefs ['Documents'] = 
array (
  'DATE_OF_DOCUMENT_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_DOCUMENT',
    'width' => '10%',
    'link' => true,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'bold' => true,
  ),
  'SUBCATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '15%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'CATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => true,
  ),
  'FILENAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'link' => true,
    'default' => true,
    'bold' => false,
    'displayParams' => 
    array (
      'module' => 'Documents',
    ),
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'document_revision_id',
      1 => 'doc_id',
      2 => 'doc_type',
      3 => 'doc_url',
    ),
  ),
  'CASE_ASSIGNED_TO_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'OUTGOING_DOCUMENT' => 
  array (
    'type' => 'bool',
    'width' => '15%',
    'label' => 'LBL_OUTGOING_DOCUMENT',
    'default' => true,
  ),
  'CASES_DOCUMENTS_NAME' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASES',
    'id' => 'case_id',
    'link' => true,
    'width' => '10%',
  ),
  'ASSIGNED_LAWYER_CASES' => 
  array (
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'default' => false,
  ),
);
