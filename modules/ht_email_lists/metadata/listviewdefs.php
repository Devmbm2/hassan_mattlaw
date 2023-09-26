<?php
$module_name = 'ht_email_lists';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_SUBJECT',
    'default' => true,
    'link' => true,
  ),
  'parent_name' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_RELATED_TO',
    'default' => true,
    'link' => false,
  ),
  'to_addr_name' => 
  array (
    'width' => '32%',
    'label' => 'LBL_TO_ADDR_NAME',
    'default' => true,
    'link' => true,
  ),
  'DATE_SENT' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_SENT',
    'width' => '10%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '7%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
);
?>
