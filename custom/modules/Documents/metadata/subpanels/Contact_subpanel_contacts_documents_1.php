<?php
// created: 2019-09-20 12:57:19
$subpanel_layout['list_fields'] = array (
  'object_image' => 
  array (
    'vname' => 'LBL_OBJECT_IMAGE',
    'widget_class' => 'SubPanelIcon',
    'width' => '2%',
    'image2' => 'attachment',
    'image2_url_field' => 
    array (
      'id_field' => 'id',
      'filename_field' => 'filename',
    ),
    'attachment_image_only' => true,
    'default' => true,
  ),
  'date_of_document_c' => 
  array (
    'name' => 'date_of_document_c',
    'vname' => 'LBL_DATE_OF_DOCUMENT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_DOC_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'contacts_documents_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_DOCUMENTS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contacts_documents_1contacts_ida',
  ),
  'filename' => 
  array (
    'name' => 'filename',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '20%',
    'module' => 'Documents',
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'Documents',
    ),
    'default' => true,
  ),
  'outgoing_document' => 
  array (
    'name' => 'outgoing_document',
    'vname' => 'LBL_OUTGOING_DOCUMENT',
    'width' => '20%',
    'default' => true,
  ),
  'get_latest' => 
  array (
    'widget_class' => 'SubPanelGetLatestButton',
    'module' => 'Documents',
    'width' => '5%',
    'default' => true,
  ),
  'load_signed' => 
  array (
    'widget_class' => 'SubPanelLoadSignedButton',
    'module' => 'Documents',
    'width' => '5%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Documents',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'Documents',
    'width' => '5%',
    'default' => true,
  ),
);