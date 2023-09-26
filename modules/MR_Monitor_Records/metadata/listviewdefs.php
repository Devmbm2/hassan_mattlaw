<?php
$module_name = 'MR_Monitor_Records';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'FROM_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_FROM_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'TO_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_TO_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'MODIFIED_BY' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_MODIFIED_BY',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
);
