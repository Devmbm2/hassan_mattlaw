<?php
$listViewDefs ['ht_hard_documents'] = 
array (
  'DATE_OF_DOCUMENT_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_DOCUMENT',
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
  'FILENAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_FILENAME',
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
  'CATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => true,
  ),
  'SUBCATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '15%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'DONE_C' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
  'EXP_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_EXP_DATE',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
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
