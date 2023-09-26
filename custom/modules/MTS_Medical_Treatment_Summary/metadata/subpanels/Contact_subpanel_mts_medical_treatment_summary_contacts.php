<?php
// created: 2019-03-28 10:57:05
$subpanel_layout['list_fields'] = array (
  'treatment_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_TREATMENT_DATE',
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'default' => true,
  ),
  'medical_provider_organization' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_MEDICAL_PROVIDER_ORGANIZATION',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Accounts',
    'target_record_key' => 'account_id_c',
  ),
  'medical_provider_person' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_MEDICAL_PROVIDER_PERSON',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id_c',
  ),
  'uploadfile' => 
  array (
    'name' => 'uploadfile',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '20%',
    'module' => 'MTS_Medical_Treatment_Summary',
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'MTS_Medical_Treatment_Summary',
    ),
    'default' => true,
  ),
  'treatment_work_product_note' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'vname' => 'LBL_TREATMENT_WORK_PRODUCT_NOTE',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'treatment_description_summary' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'vname' => 'LBL_TREATMENT_DESCRIPTION_SUMMARY',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
);
