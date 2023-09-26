<?php
// created: 2020-04-09 07:55:33
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
  'medb_medical_bills_contacts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'MEDB_MEDICAL_BILLS_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'medb_medical_bills_contactscontacts_ida',
  ),
  'document_name' => 
  array (
    'name' => 'document_name',
    'vname' => 'LBL_LIST_DOCUMENT_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'medical_provider' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_ACCOUNTS_TITLE',
    'id' => 'ACCOUNT_ID_C',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'total_charges' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_TOTAL_CHARGES',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'balance' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_BALANCE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'reduction_amount' => 
  array (
    'type' => 'currency',
    'vname' => 'LBL_REDUCTION_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'MEDB_Medical_Bills',
    'width' => '5%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'MEDB_Medical_Bills',
    'width' => '5%',
    'default' => true,
  ),
);