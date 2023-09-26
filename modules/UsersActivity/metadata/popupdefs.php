<?php
$popupMeta = array (
    'moduleMain' => 'UsersActivity',
    'varName' => 'UsersActivity',
    'orderBy' => 'UsersActivity.name',
    'whereClauses' => array (
  'name' => 'UsersActivity.name',
  'date_entered' => 'UsersActivity.date_entered',
  'ip_address' => 'UsersActivity.ip_address',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'date_entered',
  6 => 'ip_address',
),
    'searchdefs' => array (
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
    'name' => 'name',
  ),
  'date_entered' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'name' => 'date_entered',
  ),
 
  'ip_address' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'name' => 'ip_address',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'IP_ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
),
);
