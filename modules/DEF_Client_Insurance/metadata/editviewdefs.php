<?php
$module_name = 'DEF_Client_Insurance';
$viewdefs [$module_name] = 
array (
  'EditView' => 
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
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'adjuster',
            'studio' => 'visible',
            'label' => 'LBL_ADJUSTER',
          ),
          1 => 
          array (
            'name' => 'claim_number',
            'label' => 'LBL_CLAIM_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'policy_limits',
            'label' => 'LBL_POLICY_LIMITS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
          1 => 
          array (
            'name' => 'claim_result',
            'studio' => 'visible',
            'label' => 'LBL_CLAIM_RESULT',
          ),
        ),
        4 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'lit_spot',
            'studio' => 'visible',
            'label' => 'LBL_LIT_SPOT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'def_client_insurance_cases_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
