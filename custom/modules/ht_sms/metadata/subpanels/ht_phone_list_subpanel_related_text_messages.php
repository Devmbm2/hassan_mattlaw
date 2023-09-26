<?php
// created: 2020-12-16 13:18:46
$subpanel_layout['list_fields'] = array (
  'parent_name' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'vname' => 'LBL_FLEX_RELATE',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => 'parent_id',
  ),
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
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
  'message_status' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_MESSAGE_STATUS',
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
);