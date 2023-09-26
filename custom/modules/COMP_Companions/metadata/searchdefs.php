<?php
$module_name = 'COMP_Companions';
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
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
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
      'comp_companions_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
        'id' => 'COMP_COMPANIONS_CASESCASES_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'comp_companions_cases_name',
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
      'case_type_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type_c',
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
