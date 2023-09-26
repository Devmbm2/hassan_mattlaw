<?php
$module_name = 'DEF_Defendants';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_NAME',
    'default' => true,
    'link' => true,
  ),
  'INSURANCE_COMPANY' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_INSURANCE_COMPANY',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'DEFENDANT' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID1_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'DEFENDANT_ORGANIZATION_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT_ORGANIZATION',
    'id' => 'ACCOUNT_ID1_C',
    'link' => true,
    'width' => '10%',
  ),
  'DEFENDANT_ORGANIZATION_TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT_ORGANIZATION_TYPE',
    'width' => '10%',
  ),
  'POLICY_TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_POLICY_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'POLICY_LIMITS' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_POLICY_LIMITS',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
