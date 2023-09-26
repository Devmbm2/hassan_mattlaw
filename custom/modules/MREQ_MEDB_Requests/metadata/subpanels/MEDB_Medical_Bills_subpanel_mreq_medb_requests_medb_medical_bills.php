<?php
// created: 2018-09-30 20:21:55
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
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'date_requested' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_REQUESTED',
    'width' => '10%',
    'default' => true,
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_DOC_STATUS',
    'width' => '10%',
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
  'description' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MREQ_MEDB_Requests',
    'width' => '5%',
    'default' => true,
  ),
);