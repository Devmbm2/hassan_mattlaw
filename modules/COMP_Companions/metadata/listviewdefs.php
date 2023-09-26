<?php
$module_name = 'COMP_Companions';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'COMPANION' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'AGE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_AGE',
    'width' => '10%',
    'default' => true,
  ),
  'RELATIONSHIP_TO_MAIN_CLIENT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
    'width' => '10%',
    'default' => true,
  ),
  'TOTAL_LOPS_LIENS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TOTAL_LOPS_LIENS',
    'width' => '10%',
    'default' => true,
  ),
  'TOTAL_MEDICAL_BILLS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TOTAL_MEDICAL_BILLS',
    'width' => '10%',
    'default' => true,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'COMP_COMPANIONS_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
    'id' => 'COMP_COMPANIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
);
?>
