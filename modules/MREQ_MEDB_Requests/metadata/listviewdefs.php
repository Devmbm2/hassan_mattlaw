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
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
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
  'DATE_REQUESTED' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_REQUESTED',
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
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
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
