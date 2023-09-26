<?php
// created: 2021-04-27 20:20:05
$subpanel_layout['list_fields'] = array (
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'date_of_negotiation_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
  ),
  'document_name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
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
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'sent_rec' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SENT_REC',
    'width' => '10%',
    'default' => true,
  ),
  'uploadfile' => 
  array (
    'name' => 'uploadfile',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '20%',
    'module' => 'NEG_Negotiations',
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'NEG_Negotiations',
    ),
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'NEG_Negotiations',
    'width' => '5%',
    'default' => true,
  ),
);