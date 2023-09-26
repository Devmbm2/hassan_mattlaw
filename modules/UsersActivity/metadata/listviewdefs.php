<?php
$module_name = 'UsersActivity';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '15%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DATE_ENTERED' => array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true
  ), 
  'ACTION_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACTION_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'MODULE_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MODULE_NAME',
    'width' => '15%',
    'default' => true,
  ), 
  'ITEM_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_ITEM_NAME',
      
    'dynamic_module' => 'MODULE_NAME',
    'id' => 'ITEM_ID',
    'link' => true,
    'default' => true,
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'item_id',
      1 => 'item_name',
    ),  
  ),  
  'IP_ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
  
);
?>
