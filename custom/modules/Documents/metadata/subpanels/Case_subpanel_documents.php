<?php
// created: 2017-12-03 09:29:09
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
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_DOCUMENT',
    'width' => '10%',
  ),
  'category_id' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_SF_CATEGORY',
    'width' => '10%',
    'default' => true,
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
    'default' => true,
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
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
  'created_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'created_by',
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'width' => '5%',
    'vname' => 'LBL_EDIT_BUTTON',
    'default' => true,
    'widget_class' => 'SubPanelEditButton',
  ),
  'document_revision_id' => 
  array (
    'name' => 'document_revision_id',
    'usage' => 'query_only',
  ),
);