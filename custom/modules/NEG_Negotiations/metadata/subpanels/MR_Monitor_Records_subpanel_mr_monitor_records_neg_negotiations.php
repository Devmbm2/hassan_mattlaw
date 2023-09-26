<?php
// created: 2020-04-09 07:32:37
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
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'neg_negotiations_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
    'id' => 'NEG_NEGOTIATIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'neg_negotiations_casescases_ida',
  ),
  'date_of_negotiation_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'defendant' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID2_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id2_c',
  ),
  'amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_AMOUNT',
    'currency_format' => true,
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
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'NEG_Negotiations',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'NEG_Negotiations',
    'width' => '5%',
    'default' => true,
  ),
);