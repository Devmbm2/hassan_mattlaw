<?php
$module_name = 'NEG_Negotiations';
$OBJECT_NAME = 'NEG_NEGOTIATIONS';
$listViewDefs [$module_name] =
array (
  'DATE_OF_NEGOTIATION_C' =>
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
  ),
//   'DEFENDANT' =>
//   array (
//     'type' => 'relate',
//     'studio' => 'visible',
//     'label' => 'LBL_DEFENDANT',
//     'id' => 'CONTACT_ID2_C',
//     'link' => true,
//     'width' => '10%',
//     'default' => true,
//   ),
'NEG_NEGOTIATIONS_CASES_NAME' =>
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
    'id' => 'NEG_NEGOTIATIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'AMOUNT' =>
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' =>
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),

  'DOCUMENT_NAME' =>
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'UPLOADFILE' =>
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'studio' => 'visible',
    'default' => true,
    'displayParams' =>
    array (
      'module' => 'NEG_Negotiations',
    ),
  ),
  'RELATED_CASE_ASSIGNED_TO' =>
  array (
    'type' => 'varchar',
    'label' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'vname' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'width' => '10%',
    'default' => true,
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
  'saved_by' =>
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_SAVED_BY',
    'width' => '10%',
    'default' => true,
  ),
//   'DONE' =>
//   array (
//     'type' => 'bool',
//     'default' => true,
//     'label' => 'LBL_DONE',
//     'width' => '10%',
//   ),
//   'SENT_REC' =>
//   array (
//     'type' => 'enum',
//     'studio' => 'visible',
//     'label' => 'LBL_SENT_REC',
//     'width' => '10%',
//     'default' => true,
//   ),
  'DATE_ENTERED' =>
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
    'link' => true,
  ),
);
