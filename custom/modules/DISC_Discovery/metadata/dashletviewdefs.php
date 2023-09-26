<?php
$dashletData['DISC_DiscoveryDashlet']['searchFields'] = array (
   'related_case_assigned_to' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'link' => true,
    'width' => '10%',
	'sortable' => false,
  ),
  'done' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
);
$dashletData['DISC_DiscoveryDashlet']['columns'] = array (
  'date_served' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_SERVED',
    'width' => '10%',
    'default' => true,
    'link' => true,
  ),
  'disc_discovery_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
    'id' => 'DISC_DISCOVERY_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'parent_name' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'label' => 'LBL_FLEX_RELATE',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'DISC_Discovery',
    ),
  ),
  'related_case_assigned_to' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'link' => true,
    'width' => '10%',
	'sortable' => false,
  ),
  'done' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
    'sent_received' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_RECEIVED',
    'width' => '10%',
    'default' => true,
  ),
);
