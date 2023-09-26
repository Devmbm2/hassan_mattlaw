<?php
// created: 2019-04-08 15:53:15
$subpanel_layout['list_fields'] = array (
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'from_number' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_FROM_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'sent_received' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SENT_RECEIVED',
    'width' => '10%',
    'default' => true,
  ),
  'to_number' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_TO_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'description' => 
  array (
    'type' => 'text',
    'vname' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'ht_sms',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'ht_sms',
    'width' => '5%',
    'default' => true,
  ),
);