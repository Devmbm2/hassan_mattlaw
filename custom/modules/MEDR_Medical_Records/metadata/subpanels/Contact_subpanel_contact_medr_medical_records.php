<?php
// created: 2020-09-28 23:34:25
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
    //'widget_class' => 'SubPanelDetailViewLink',
  ),
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
  ),
  'document_name' => 
  array (
    'vname' => 'LBL_LIST_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'medical_provider' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_MEDICAL_PROVIDER',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
    'widget_class' => 'SubPanelDetailViewLink',
  ),
  'date_range_requested_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_DATE_RANGE_REQUESTED',
    'width' => '10%',
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'MEDR_Medical_Records',
    ),
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'default' => true,
    'vname' => 'LBL_DOC_STATUS',
    'width' => '10%',
  ),
  'med_summary_status_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_MED_SUMMARY_STATUS',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MEDR_Medical_Records',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'MEDR_Medical_Records',
    'width' => '5%',
    'default' => true,
  ),
);
