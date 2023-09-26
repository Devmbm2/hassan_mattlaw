<?php
$listViewDefs ['Emails'] = 
array (
  'DATE_ENTERED' => 
  array (
    'width' => '32%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
    'link' => true,
  ),
  'TO_ADDRS_NAMES' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_TO_ADDR',
    'default' => true,
  ),
  'FROM_ADDR_NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_FROM_ADDR',
    'default' => true,
  ),
  'PARENT_TYPE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PARENT_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'SUBJECT' => 
  array (
    'width' => '32%',
    'label' => 'LBL_LIST_SUBJECT',
    'default' => true,
    'link' => true,
    'customCode' => '',
  ),
  'INDICATOR' => 
  array (
    'width' => '32%',
    'label' => 'LBL_INDICATOR',
    'default' => false,
    'sortable' => false,
    'hide_header_label' => true,
  ),
  'NAME' => 
  array (
    'type' => 'name',
    'label' => 'LBL_SUBJECT',
    'width' => '10%',
    'default' => false,
  ),
  'CASES' => 
  array (
    'width' => '32%',
    'label' => 'LBL_EMAILS_CASES_REL',
    'default' => false,
    'link' => false,
    'type' => 'link',
    'relationship' => 'emails_cases_rel',
    'module' => 'Cases',
    'bean_name' => 'Case',
    'source' => 'non-db',
  ),
  'CATEGORY_ID' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => false,
  ),
  'REPLY_TO_ADDR' => 
  array (
    'type' => 'varchar',
    'label' => 'reply_to_addr',
    'width' => '10%',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'HAS_ATTACHMENT' => 
  array (
    'width' => '32%',
    'label' => 'LBL_HAS_ATTACHMENT_INDICATOR',
    'default' => false,
    'sortable' => false,
    'hide_header_label' => true,
  ),
);
