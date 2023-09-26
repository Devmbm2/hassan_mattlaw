<?php
$module_name = 'DEF_Client_Insurance';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
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
  'POLICY_LIMITS' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_POLICY_LIMITS',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ADJUSTER' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_ADJUSTER',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'CLAIM_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CLAIM_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'DEF_CLIENT_INSURANCE_CASES_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_CASES_TITLE',
    'id' => 'DEF_CLIENT_INSURANCE_CASES_1CASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
);
?>
