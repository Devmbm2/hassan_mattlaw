<?php
$module_name = 'MREQ_MEDB_Requests';
$OBJECT_NAME = 'MREQ_MEDB_REQUESTS';
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
  'RELATED_RUNNING_BILL_CLIENT' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_RELATED_RUNNING_BILL_CLIENT',
    'width' => '10%',
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
  ),
  'STATUS_ID' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MDOC_INCOMING_BILLS_TITLE',
    'id' => 'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTSMDOC_INCOMING_BILLS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_RANGE_BILLS_LIENS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DATE_RANGE_BILLS_LIENS',
    'width' => '10%',
  ),
  'DATE_REQUESTED' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_REQUESTED',
    'width' => '10%',
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
    'id' => 'MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLSMEDB_MEDICAL_BILLS_IDA',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => false,
    'displayParams' => 
    array (
      'module' => 'MREQ_MEDB_Requests',
    ),
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
  'RECEIVEDDATE_C' =>
    array (
      'type' => 'date',
      'label' => 'LBL_RECEIVEDDATE_C',
      'width' => '10%',
      'default' => true,
    ),
);
