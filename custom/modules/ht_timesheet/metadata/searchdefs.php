<?php
$module_name = 'ht_timesheet';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'start_time' => 
      array (
        'type' => 'time',
        'label' => 'LBL_START_TIME',
        'width' => '10%',
        'default' => true,
        'name' => 'start_time',
      ),
      'end_time' => 
      array (
        'type' => 'time',
        'label' => 'LBL_END_TIME',
        'width' => '10%',
        'default' => true,
        'name' => 'end_time',
      ),
      'work_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_WORK_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'work_date',
      ),
      'day' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DAY',
        'width' => '10%',
        'default' => true,
        'name' => 'day',
      ),
      'ip_address' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_IP_ADDRESS',
        'width' => '10%',
        'default' => true,
        'name' => 'ip_address',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
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
