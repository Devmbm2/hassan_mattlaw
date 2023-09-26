<?php
$searchdefs ['ht_hard_documents'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'favorites_only' => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
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
    ),
    'advanced_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
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
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'template_type' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_TEMPLATE_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'template_type',
      ),
      'category_id' => 
      array (
        'name' => 'category_id',
        'default' => true,
        'width' => '10%',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'subcategory_id' => 
      array (
        'name' => 'subcategory_id',
        'default' => true,
        'width' => '10%',
      ),
      'done_c' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_DONE',
        'width' => '10%',
        'name' => 'done_c',
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
        'width' => '10%',
      ),
      'active_date' => 
      array (
        'name' => 'active_date',
        'default' => true,
        'width' => '10%',
      ),
      'exp_date' => 
      array (
        'name' => 'exp_date',
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
