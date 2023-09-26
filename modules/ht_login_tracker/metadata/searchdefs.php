<?php
$module_name = 'ht_login_tracker';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
        'label' => 'LBL_NAME_NEW',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO_NEW',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'width' => '10%',
        'default' => true,
      ),
      'login_timestamp' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_LOGIN_TIMESTAMP',
        'width' => '10%',
        'default' => true,
        'name' => 'login_timestamp',
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
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
        'label' => 'LBL_NAME_NEW',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO_NEW',
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
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'date_modified' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_modified',
      ),
      'login_timestamp' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_LOGIN_TIMESTAMP',
        'width' => '10%',
        'default' => true,
        'name' => 'login_timestamp',
      ),
      'ip_address' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_IP_ADDRESS',
        'width' => '10%',
        'default' => true,
        'name' => 'ip_address',
      ),
      'operating_system' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_OPERATING_SYSTEM',
        'width' => '10%',
        'default' => true,
        'name' => 'operating_system',
      ),
      'device' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DEVICE',
        'width' => '10%',
        'default' => true,
        'name' => 'device',
      ),
      'browser' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_BROWSER',
        'width' => '10%',
        'default' => true,
        'name' => 'browser',
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
;
?>
