<?php
$module_name = 'COMP_Companions';
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
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
          1 => 
          array (
            'name' => 'age',
            'label' => 'LBL_AGE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'total_lops_liens',
            'label' => 'LBL_TOTAL_LOPS_LIENS',
          ),
          1 => 
          array (
            'name' => 'total_medical_bills',
            'label' => 'LBL_TOTAL_MEDICAL_BILLS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'relationship_to_main_client',
            'studio' => 'visible',
            'label' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
          ),
          1 => 'description',
        ),
      ),
    ),
  ),
);
?>
