<?php
// created: 2019-11-07 08:02:55
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
  'subcategory_id' =>
  array (
    'name' => 'subcategory_id',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
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
  'category_id' =>
  array (
    'type' => 'enum',
    'vname' => 'LBL_SF_CATEGORY',
    'width' => '10%',
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
  'document_revision_id' =>
  array (
    'name' => 'document_revision_id',
    'usage' => 'query_only',
  ),
);
