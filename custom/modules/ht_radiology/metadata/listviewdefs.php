<?php
$module_name = 'ht_radiology';
$OBJECT_NAME = 'HT_RADIOLOGY';
$listViewDefs [$module_name] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'CASE_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CASE_NAME',
    'id' => 'CASE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACT_NAME',
    'id' => 'CONTACT_ID',
    'width' => '10%',
    'default' => true,
  ),
  'FORMAT' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_FORMAT',
    'width' => '10%',
    'default' => true,
  ),
  'ACTIVE_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ACTIVE_DATE',
    'default' => true,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MODIFIED_USER',
    'module' => 'Users',
    'id' => 'USERS_ID',
    'default' => false,
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'modified_user_id',
    ),
  ),
  'CATEGORY_ID' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => false,
  ),
  'SUBCATEGORY_ID' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => false,
  ),
);
