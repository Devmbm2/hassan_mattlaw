<?php
$module_name = 'ht_sms';
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
        'name' => 'parent_name',
      ),
      'sent_received' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SENT_RECEIVED',
        'width' => '10%',
        'default' => true,
        'name' => 'sent_received',
      ),
      'from_number' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_FROM_NUMBER',
        'width' => '10%',
        'default' => true,
        'name' => 'from_number',
      ),
      'to_number' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_TO_NUMBER',
        'width' => '10%',
        'default' => true,
        'name' => 'to_number',
      ),
      'message_status' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_MESSAGE_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'message_status',
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
