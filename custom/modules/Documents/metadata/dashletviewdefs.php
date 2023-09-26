<?php
$dashletData['DocumentsDashlet']['searchFields'] = array (
  'name' => 
  array (
    'default' => '',
  ),
  'assigned_lawyer_cases' => 
  array (
    'default' => '',
  ),
  'done_c' => 
  array (
    'default' => '',
  ),
  'subcategory_id' => 
  array (
    'default' => '',
  ),
  'hard_or_soft_doc' => 
  array (
    'default' => '',
  ),
  'status_id' => 
  array (
    'default' => '',
  ),
  'category_id' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
);
$dashletData['DocumentsDashlet']['columns'] = array (
  'date_of_document_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_DOCUMENT',
    'width' => '10%',
    'link' => true,
  ),
  'cases_documents_name' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASES',
    'id' => 'case_id',
    'link' => true,
    'width' => '10%',
  ),
  'document_name' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'bold' => true,
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'width' => '15%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'filename' => 
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
  'related_case_assigned_to' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'link' => true,
    'width' => '10%',
	'sortable' => false,
  ),
  'outgoing_document' => 
  array (
    'type' => 'bool',
    'width' => '15%',
    'label' => 'LBL_OUTGOING_DOCUMENT',
    'default' => true,
  ),
  'category_id' => 
  array (
    'type' => 'enum',
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => true,
  ),
  'case_status_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_STATUS',
    'width' => '10%',
  ),
  'assigned_lawyer_cases' => 
  array (
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'default' => false,
  ),
);
