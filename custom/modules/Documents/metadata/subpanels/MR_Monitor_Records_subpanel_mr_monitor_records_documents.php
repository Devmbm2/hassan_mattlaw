<?php
// created: 2020-04-09 06:55:46
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
    'width' => '20%',
    'default' => true,
  ),
  'date_of_document_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_DOCUMENT',
    'width' => '10%',
  ),
  'cases_documents_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CASES',
    'id' => 'CASE_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'case_id',
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
    'default' => true,
  ),
  'done_c' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_DONE',
    'width' => '10%',
  ),
  'category_id' => 
  array (
    'name' => 'category_id',
    'vname' => 'LBL_LIST_CATEGORY',
    'width' => '20%',
    'default' => true,
  ),
  'case_assigned_to_c' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_CASE_ASSIGNED_TO',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'user_id_c',
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