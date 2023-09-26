<?php
$listViewDefs ['Cases'] = 
array (
  'NAME' => 
  array (
    'width' => '80%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'sortable' => false,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
    'sortable' => false,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'default' => true,
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'sortable' => false,
  ),
  'CASE_STATUS_NO_OF_DAYS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CASE_STATUS_NO_OF_DAYS',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_OF_INCIDENT_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_INCIDENT',
    'width' => '10%',
    'sortable' => false,
  ),
  'TOTAL_CASE_LENGTH_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_TOTAL_CASE_LENGTH',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'link' => false,
    'sortable' => false,
  ),
  'DEFAULT_ASSISTANT_LAWYER_NAME' => 
  array (
    'type' => 'relate',
    'label' => 'LBL_DEFAULT_ASSISTANT_NAME',
    'id' => 'DEFAULT_ASSISTANT_LAWYER_ID',
    'link' => false,
    'width' => '10%',
    'default' => true,
    'sortable' => false,
  ),
  'MDP_ESTIMATED_CASE_VALUE_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
    'currency_format' => true,
    'width' => '10%',
    'ext2' => 'Cases',
    'sortable' => false,
  ),
  'CASE_INSURANCE_SUMMARY_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CASE_INSURANCE_SUMMARY',
    'width' => '10%',
    'sortable' => false,
  ),
  'PRE_TRIAL_CONFERENCE_HEARING_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_PRE_TRIAL_CONFERENCE_HEARING',
    'width' => '10%',
    'sortable' => false,
  ),
  'FILTER_5' => 
  array (
    'width' => '5%',
    'label' => 'LBL_FILTER_5',
    'default' => true,
    'type' => 'varchar',
    'source' => 'non-db',
    'sortable' => false,
  ),
  'FILTER_6' => 
  array (
    'width' => '5%',
    'label' => 'LBL_FILTER_6',
    'default' => true,
    'type' => 'varchar',
    'source' => 'non-db',
    'sortable' => false,
  ),
  'JUDGE_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_JUDGE',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'sortable' => false,
  ),
  'REFERRAL_PERSON_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_REFERRAL_PERSON',
    'id' => 'CONTACT_ID4_C',
    'link' => true,
    'width' => '10%',
    'sortable' => false,
  ),
);
