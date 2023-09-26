<?php
$module_name = 'MDOC_Incoming_Bills';
$OBJECT_NAME = 'MDOC_INCOMING_BILLS';
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
/*    'RELATED_RUNNING_BILL_CLIENT' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_RELATED_RUNNING_BILL_CLIENT',
    'width' => '10%',
    'default' => true,
    'sortable' => false,
  ), */
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_DOCUMENT_NAME',
    'link' => true,
    'default' => true,
  ),
  'RUNNING_SUMMARY_UPDATED_C' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_RUNNING_SUMMARY_UPDATED',
    'width' => '10%',
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => true,
  ),
  'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
    'id' => 'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTSMREQ_MEDB_REQUESTS_IDB',
    'width' => '10%',
    'default' => true,
  ),
/*   'MODIFIED_BY_NAME' => 
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
  ), */
/*   'MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
    'id' => 'MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1MEDB_MEDICAL_BILLS_IDA',
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
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ), */
);
