<?php
$module_name = 'AOK_KnowledgeBase';
$listViewDefs [$module_name] = 
array (
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
	'link' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'CATEGORY_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CATEGORY',
    'width' => '10%',
  ),
  'LINK_TO_TUTORIAL_C' => 
  array (
    'type' => 'url',
    'default' => true,
    'label' => 'LBL_LINK_TO_TUTORIAL',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
  'AUTHOR' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_AUTHOR',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => false,
  ),
);
