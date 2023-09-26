<?php
$searchdefs ['Bugs'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
      ),
      'open_only' => 
      array (
        'name' => 'open_only',
        'label' => 'LBL_OPEN_ITEMS',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'bug_number' => 
      array (
        'name' => 'bug_number',
        'default' => true,
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
      ),
      'resolution' => 
      array (
        'name' => 'resolution',
        'default' => true,
      ),
      'found_in_release' => 
      array (
        'name' => 'found_in_release',
        'default' => true,
      ),
      'fixed_in_release' => 
      array (
        'name' => 'fixed_in_release',
        'default' => true,
      ),
      'type' => 
      array (
        'name' => 'type',
        'default' => true,
      ),
      'status' => 
      array (
        'name' => 'status',
        'default' => true,
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
      ),
      'priority' => 
      array (
        'name' => 'priority',
        'default' => true,
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
