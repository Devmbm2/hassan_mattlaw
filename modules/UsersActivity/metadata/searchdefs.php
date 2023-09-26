<?php
$module_name = 'UsersActivity';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_NAME',
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
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'action_name' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_ACTION',
        'width' => '10%',
        'default' => true,
        'name' => 'action_name',
      ),
      'module_name' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_MODULE',
        'width' => '10%',
        'function' => 
        array (
          'name' => 'UsersActivity::getModuleList',
        ),  
        'default' => true,
        'name' => 'module_name',
      ),  
    ),
    'advanced_search' => 
    array (
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_NAME',
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
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'action_name' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_ACTION',
        'width' => '10%',
        'default' => true,
        'name' => 'action_name',
      ),
      'module_name' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_MODULE',
        'width' => '10%',
        'function' => 
        array (
          'name' => 'UsersActivity::getModuleList',
        ),  
        'default' => true,
        'name' => 'module_name',
      ), 
      'ip_address' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_IP_ADDRESS',
        'width' => '10%',
        'default' => true,
        'name' => 'ip_address',
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
?>
