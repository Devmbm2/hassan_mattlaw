<?php
// created: 2019-09-28 00:32:05
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
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'date_of_negotiation_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
  ),
  'sent_rec' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SENT_REC',
    'width' => '10%',
    'default' => true,
  ),
  'adjuster_lawyer' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_ADJUSTER_LAWYER',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id_c',
  ),
  'insurance_company' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_INSURANCE_COMPANY',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
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