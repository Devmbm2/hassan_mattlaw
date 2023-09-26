<?php
$module_name = 'DEF_Defendants';
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
          0 => 'name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'defendant',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT',
          ),
          1 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        2 => 
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
        3 => 
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
        4 => 
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
        5 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'date_of_incident',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'lit_spot',
            'studio' => 'visible',
            'label' => 'LBL_LIT_SPOT',
          ),
        ),
      ),
    ),
  ),
);
?>
