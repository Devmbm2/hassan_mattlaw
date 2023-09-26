<?php
$listViewDefs ['Users'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'related_fields' => 
    array (
      0 => 'last_name',
      1 => 'first_name',
    ),
    'orderBy' => 'last_name',
    'default' => true,
  ),
  'USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_USER_NAME',
    'link' => true,
    'default' => true,
  ),
  'INITIALS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_INITIALS',
    'width' => '10%',
  ),
  'EMAIL1' => 
  array (
    'width' => '30%',
    'sortable' => false,
    'label' => 'LBL_LIST_EMAIL',
    'link' => true,
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'IS_ADMIN' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ADMIN',
    'link' => false,
    'default' => true,
  ),
  'DEFAULT_LETTERHEAD' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_DEFAULT_LETTERHEAD',
    'width' => '10%',
    'default' => true,
  ),
 /*  'SLACK_TOKEN' => 
  array (
    'type' => 'varchar',
    'label' => 'slack_token',
    'width' => '10%',
    'default' => true,
  ), */
);
