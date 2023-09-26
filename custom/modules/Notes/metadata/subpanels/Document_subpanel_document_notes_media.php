<?php
// created: 2019-10-17 11:34:30
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
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '50%',
    'default' => true,
  ),
  'contact_name' => 
  array (
    'module' => 'Contacts',
    'vname' => 'LBL_LIST_CONTACT_NAME',
    'width' => '20%',
    'target_record_key' => 'contact_id',
    'target_module' => 'Contacts',
    'widget_class' => 'SubPanelDetailViewLink',
    'default' => true,
  ),
   'FILENAME' => 
  array (
    'width' => '20%',
    'vname' => 'LBL_LIST_VIEW_NOTE2',
    'default' => true,
    'type' => 'file',
    'related_fields' => 
    array (
      0 => 'file_url',
      1 => 'id',
    ),
    'displayParams' => 
    array (
      'module' => 'Notes',
    ),
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_LIST_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Notes',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'width' => '2%',
    'default' => true,
  ),
  'filename' => 
  array (
    'usage' => 'query_only',
  ),
  'file_url' => 
  array (
    'usage' => 'query_only',
  ),
);
