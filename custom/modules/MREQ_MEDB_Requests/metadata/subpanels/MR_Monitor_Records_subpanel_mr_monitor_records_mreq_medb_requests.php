<?php
// created: 2020-04-09 07:17:29
$subpanel_layout['list_fields'] = array (
  'object_image' => 
  array (
    'widget_class' => 'SubPanelIcon',
    'width' => '2%',
    'image2' => 'attachment',
    'image2_url_field' => 
    array (
      'id_field' => 'selected_revision_id',
      'filename_field' => 'selected_revision_filename',
    ),
    'attachment_image_only' => true,
    'default' => true,
  ),
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'mdoc_medb_doc_mreq_medb_requests_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MDOC_INCOMING_BILLS_TITLE',
    'id' => 'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTSMDOC_INCOMING_BILLS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'MDOC_Incoming_Bills',
    'target_record_key' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
  ),
  'mreq_medb_requests_medb_medical_bills_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
    'id' => 'MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLSMEDB_MEDICAL_BILLS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'MEDB_Medical_Bills',
    'target_record_key' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'date_range_bills_liens_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_DATE_RANGE_BILLS_LIENS',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MREQ_MEDB_Requests',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'MREQ_MEDB_Requests',
    'width' => '5%',
    'default' => true,
  ),
);