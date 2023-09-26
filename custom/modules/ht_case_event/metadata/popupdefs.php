<?php
$popupMeta = array (
    'moduleMain' => 'ht_case_event',
    'varName' => 'ht_case_event',
    'orderBy' => 'ht_case_event.name',
    'whereClauses' => array (
  'name' => 'ht_case_event.name',
  'ht_case_event_cases_name' => 'ht_case_event.ht_case_event_cases_name',
  'assigned_user_name' => 'ht_case_event.assigned_user_name',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'ht_case_event_cases_name',
  5 => 'assigned_user_name',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'ht_case_event_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_HT_CASE_EVENT_CASES_FROM_CASES_TITLE',
    'id' => 'HT_CASE_EVENT_CASESCASES_IDA',
    'width' => '10%',
    'name' => 'ht_case_event_cases_name',
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'name' => 'assigned_user_name',
  ),
),
);
