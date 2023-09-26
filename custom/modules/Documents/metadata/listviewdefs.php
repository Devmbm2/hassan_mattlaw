<?php
$listViewDefs ['Documents'] =
array (
//   'DATE_OF_DOCUMENT_C' =>
//   array (
//     'type' => 'date',
//     'default' => true,
//     'label' => 'LBL_DATE_OF_DOCUMENT',
//     'width' => '10%',
//     'link' => true,
//   ),
    'DATE_ENTERED' =>
    array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'link' => true,
    ),
  'DATESENTOUT_C' =>
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATESENTOUT',
    'width' => '10%',
    'link' => true,
  ),
  'CASES_DOCUMENTS_NAME' =>
  array (
    // 'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASES',
    // 'id' => 'case_id',
    'link' => true,
    'width' => '10%',
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
  'RELATED_CASE_ASSIGNED_TO' =>
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'link' => true,
    'width' => '10%',
	'sortable' => false,
  ),
  'RELATED_CASE_ASSISTANT' =>
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RELATED_CASE_ASSISTANT',
    'width' => '10%',
    'source' => 'non-db',
    'sortable' => false,
  ),

  'ASSIGNED_LAWYER_CASES' =>
  array (
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'default' => false,
  ),
  'SENTOUTSTATUS_C' =>
  array (
    'label' => 'LBL_SENTOUTSTATUS',
    'type' => 'enum',
    'width' => '10%',
    'default' => true,
  ),
  'SAVED_BY_NAME' =>
  array (
    'label' => 'LBL_SAVED_BY_NAME',
    'type' => 'varchar',
    'width' => '10%',
    'default' => true,
  ),
);
