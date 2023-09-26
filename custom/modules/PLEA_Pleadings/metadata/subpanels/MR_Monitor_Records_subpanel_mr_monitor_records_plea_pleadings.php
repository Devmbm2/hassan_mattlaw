<?php
// created: 2020-04-09 07:35:21
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
  'date_filed_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_FILED',
    'width' => '10%',
  ),
  'plea_pleadings_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
    'id' => 'PLEA_PLEADINGS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'plea_pleadings_casescases_ida',
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'default' => true,
    'vname' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
  ),
  'done_c' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_DONE',
    'width' => '10%',
  ),
  'incoming_or_outgoing' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_INCOMING_OR_OUTGOING',
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'PLEA_Pleadings',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'PLEA_Pleadings',
    'width' => '5%',
    'default' => true,
  ),
);