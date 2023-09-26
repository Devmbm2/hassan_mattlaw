<?php
$module_name = 'MREQ_MEDB_Requests';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'mreq_medb_requests_medb_medical_bills_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
        'id' => 'MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLSMEDB_MEDICAL_BILLS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'mreq_medb_requests_medb_medical_bills_name',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'date_requested' => 
      array (
        'type' => 'date',
        'label' => 'LBL_DATE_REQUESTED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_requested',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
    ),
    'advanced_search' => 
    array (
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'date_requested' => 
      array (
        'type' => 'date',
        'label' => 'LBL_DATE_REQUESTED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_requested',
      ),
      'mreq_medb_requests_medb_medical_bills_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLSMEDB_MEDICAL_BILLS_IDA',
        'name' => 'mreq_medb_requests_medb_medical_bills_name',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
