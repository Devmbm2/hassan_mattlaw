<?php
$module_name = 'ht_Damages';
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
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => '',
        ),
        1 => 
        array (
          0 => 'description',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'file',
            'comment' => 'File name associated with the note (attachment)',
            'label' => 'LBL_FILE',
          ),
          1 => 
          array (
            'name' => 'value_c',
            'label' => 'LBL_VALUE_C',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'case_name',
            'comment' => 'The name of the case represented by the case_id field',
            'label' => 'LBL_CASE_NAME',
          ),
          1 => '',
        ),
        // 4 => 
        // array (
        //   0 => 
        //   array (
        //     'name' => 'memo',
        //     'label' => 'LBL_MEMO',
        //   ),
        // ),
        5 => 
        array (
          0 => 'assigned_user_name',
          1 => '',
        ),
      ),
    ),
  ),
);
