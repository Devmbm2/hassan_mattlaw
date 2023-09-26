<?php
$module_name='UsersActivity';
$subpanel_layout = array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'UsersActivity',
    ),
  ),
  'where' => '',
  'list_fields' => 
  array (
    'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => '45%',
      'default' => true,
    ),
    'date_entered' => 
    array (
      'type' => 'datetimecombo',
      'vname' => 'LBL_DATE_ENTERED',
      'width' => '10%',
      'default' => true,
    ),
    'action_name' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_ACTION_NAME',
      'width' => '10%',
      'default' => true,
    ),
    'module_name' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_MODULE_NAME',
      'width' => '10%',
      'default' => true,
    ),
    'ip_address' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_IP_ADDRESS',
      'width' => '10%',
      'default' => true,
    ),
    'edit_button' => 
    array (
      'widget_class' => 'SubPanelEditButton',
      'module' => 'UsersActivity',
      'width' => '4%',
      'default' => true,
    ),
    'remove_button' => 
    array (
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'UsersActivity',
      'width' => '5%',
      'default' => true,
    ),
  ),
);