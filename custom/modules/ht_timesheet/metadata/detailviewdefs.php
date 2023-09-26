<?php
$module_name = 'ht_timesheet';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 'date_entered',
          1 => 'date_modified',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'login',
            'label' => 'LBL_LOGIN',
          ),
          1 => 
          array (
            'name' => 'logout',
            'label' => 'LBL_LOGOUT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'logged_hours',
            'label' => 'LBL_LOGGED_HOURS',
          ),
          1 => 
          array (
            'name' => 'idle_time',
            'label' => 'LBL_IDLE_TIME',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'start_time',
            'label' => 'LBL_START_TIME',
          ),
          1 => 
          array (
            'name' => 'end_time',
            'label' => 'LBL_END_TIME',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'day',
            'label' => 'LBL_DAY',
          ),
          1 => 
          array (
            'name' => 'work_date',
            'label' => 'LBL_WORK_DATE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'lunch_start',
            'label' => 'LBL_LUNCH_START',
          ),
          1 => 
          array (
            'name' => 'ip_address',
            'label' => 'LBL_IP_ADDRESS',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'regular_hours',
            'label' => 'LBL_REGULAR_HOURS',
          ),
          1 => 
          array (
            'name' => 'overtime_hours',
            'label' => 'LBL_OVERTIME_HOURS',
          ),
        ),
        8 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'certify_timesheet',
            'label' => 'LBL_CERTIFY_TIMESHEET',
          ),
        ),
      ),
    ),
  ),
);
