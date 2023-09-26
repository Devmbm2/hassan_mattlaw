<?php
// created: 2019-11-07 08:01:09
$subpanel_layout['list_fields'] = array (
  'object_image' => 
  array (
    'width' => '2%',
    'vname' => 'LBL_OBJECT_IMAGE',
    'default' => true,
    'widget_class' => 'SubPanelIcon',
  ),
  // 'date_entered' => 
  // array (
  //   'type' => 'datetime',
  //   'vname' => 'LBL_DATE_ENTERED',
  //   'width' => '10%',
  //   'default' => true,
  // ),
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
    'vname' => 'LBL_LIST_SOFT_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
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
//   'filedownload' => 
//   array (
//     'name' => 'filedownload',
//     'vname' => 'LBL_LIST_VIEW_DOCUMENT_DOWNLOAD',
//     'width' => '20%',
//     'module' => 'Documents',
//     'sortable' => false,
//     'default' => true,
//     'customCode' => '<a href="" target="_blank" style="border-bottom: 0px;color: #e56455;font-weight: bold;">
// Download File 
// </a>',
//   ),
  'done_c' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_DONE',
    'width' => '10%',
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