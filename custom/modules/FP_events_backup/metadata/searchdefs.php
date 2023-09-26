<?php
$module_name = 'FP_events';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'date_start' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'case_event_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CASE_EVENT',
        'link' => true,
        'width' => '10%',
        'id' => 'ACASE_ID_C',
        'name' => 'case_event_c',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'default' => true,
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
        'name' => 'parent_name',
      ),
      'multiple_assigned_users' => 
      array (
        'type' => 'multienum',
        'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
        'width' => '10%',
        'default' => true,
        'name' => 'multiple_assigned_users',
        'id' => 'MULTIPLE_ASSIGNED_USERS',
      ),
    ),
    'advanced_search' => 
    array (
      'date_start' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'date_start',
      ),
      'multiple_assigned_users' => 
      array (
        'type' => 'multienum',
        'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
        'width' => '10%',
        'default' => true,
        'name' => 'multiple_assigned_users',
        'id' => 'MULTIPLE_ASSIGNED_USERS',
      ),
      'assigned_lawyer_cases' => 
      array (
        'name' => 'assigned_lawyer_cases',
        'label' => 'LBL_ASSIGNED_LAWYER_CASES',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'assigned_lawyer_cases_list',
        'default' => true,
      ),
      'case_status' => 
      array (
        'name' => 'case_status',
        'label' => 'LBL_CASE_STATUS',
        'type' => 'multienum',
        'width' => '10%',
        'options' => 'case_status_dom',
        'default' => true,
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_FLEX_RELATE',
        'link' => true,
        'sortable' => false,
        'related_fields' => 
        array (
          0 => 'parent_id',
          1 => 'parent_type',
        ),
        'width' => '10%',
        'ACLTag' => 'PARENT',
        'dynamic_module' => 'PARENT_TYPE',
        'id' => 'PARENT_ID',
        'name' => 'parent_name',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TYPE',
        'width' => '10%',
        'name' => 'type_c',
      ),
      'date_end' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_DATE_END',
        'width' => '10%',
        'default' => true,
        'name' => 'date_end',
      ),
      'fp_event_locations_fp_events_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENT_LOCATIONS_TITLE',
        'id' => 'FP_EVENT_LOCATIONS_FP_EVENTS_1FP_EVENT_LOCATIONS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'fp_event_locations_fp_events_1_name',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'name' => 'status',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
