<?php
$module_name = 'DEF_Defendants';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
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
          1 => 
          array (
            'name' => 'defendant',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'policy_type',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_TYPE',
          ),
          1 => 
          array (
            'name' => 'policy_limits',
            'label' => 'LBL_POLICY_LIMITS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'claim_number',
            'label' => 'LBL_CLAIM_NUMBER',
          ),
          1 => 
          array (
            'name' => 'adjuster',
            'studio' => 'visible',
            'label' => 'LBL_ADJUSTER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
