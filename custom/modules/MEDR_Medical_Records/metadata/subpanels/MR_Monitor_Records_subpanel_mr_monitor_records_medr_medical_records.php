<?php
// created: 2020-04-09 07:19:59
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
  'medr_medical_records_contacts_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
    'id' => 'MEDR_MEDICAL_RECORDS_CONTACTSCONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'medr_medical_records_contactscontacts_ida',
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
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'name_of_doctor' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_NAME_OF_DOCTOR',
    'width' => '10%',
    'default' => true,
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