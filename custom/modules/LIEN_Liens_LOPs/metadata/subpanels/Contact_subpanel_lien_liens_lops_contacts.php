<?php
// created: 2017-10-08 13:14:42
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
  'filename' =>
  array (
    'name' => 'uploadfile',
    'vname' => 'LBL_FILENAME',
    'width' => '20%',
    'module' => 'LIEN_Liens_LOPs',
    'sortable' => false,
    'displayParams' =>
    array (
      'module' => 'LIEN_Liens_LOPs',
    ),
    'default' => true,
  ),
  'lien_liens_lops_contacts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_LIEN_LIENS_LOPS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'LIEN_LIENS_LOPS_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'lien_liens_lops_contactscontacts_ida',
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'lien_lop_holder' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_LIEN_LOP_HOLDER',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'total_amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'total_owed' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL_OWED',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'LIEN_Liens_LOPs',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'LIEN_Liens_LOPs',
    'width' => '5%',
    'default' => true,
  ),
);
