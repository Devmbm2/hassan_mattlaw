<?php
// created: 2020-04-09 06:51:11
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
  'date_modified' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
  'disc_discovery_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
    'id' => 'DISC_DISCOVERY_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'disc_discovery_casescases_ida',
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'done' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_DONE',
    'width' => '10%',
  ),
  'sent_received' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SENT_RECEIVED',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'DISC_Discovery',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'DISC_Discovery',
    'width' => '5%',
    'default' => true,
  ),
);