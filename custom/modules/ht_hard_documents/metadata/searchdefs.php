<?php
$module_name = 'ht_hard_documents';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
   /*  'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
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
        'width' => '10%',
        'default' => true,
      ),
      'user_name' => 
      array (
        'link' => true,
        'type' => 'relate',
        'label' => 'LBL_RELATED_ASSIGNED_TO_CASE',
        'width' => '10%',
        'default' => true,
        'id' => 'USER_ID',
        'name' => 'user_name',
      ),
    ), */
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
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
      'user_name' => 
      array (
        'link' => true,
        'type' => 'relate',
        'label' => 'LBL_RELATED_ASSIGNED_TO_CASE',
        'width' => '10%',
        'default' => true,
        'id' => 'USER_ID',
        'name' => 'user_name',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
    ),
	'advanced_search' => 
	array(
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
