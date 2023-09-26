<?php
// created: 2020-02-14 23:04:54
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
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'subcategory_id' => 
  array (
    'name' => 'subcategory_id',
    'vname' => 'LBL_SF_SUBCATEGORY_INVESTIGATION',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'investigation_types_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_INVESTIGATION_TYPES',
    'width' => '10%',
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