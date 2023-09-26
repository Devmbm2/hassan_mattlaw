<?php
// created: 2020-04-01 03:41:40
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
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'medb_medical_bills_mdoc_incoming_bills_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
    'id' => 'MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1MEDB_MEDICAL_BILLS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'MEDB_Medical_Bills',
    'target_record_key' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
	'sortable' => false
  ),
  'document_name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '45%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'running_summary_updated_c' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_RUNNING_SUMMARY_UPDATED',
    'width' => '10%',
	'sortable' => false
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'MDOC_Incoming_Bills',
    ),
	'sortable' => false
  ),
  'mdoc_medb_doc_mreq_medb_requests_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
    'id' => 'MDOC_MEDB_DOC_MREQ_MEDB_REQUESTSMREQ_MEDB_REQUESTS_IDB',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'MREQ_MEDB_Requests',
    'target_record_key' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
	'sortable' => false
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MDOC_Incoming_Bills',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'MDOC_Incoming_Bills',
    'width' => '5%',
    'default' => true,
	
  ),
);
