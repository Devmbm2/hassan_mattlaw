<?php
$module_name = 'ht_Claim_Number';
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
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'account_name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 'insurance_type',
          1 => 'claim_number',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'insured_claim_test',
            'label' => 'LBL_INSURED_C',
          ),
          1 => 
          array (
            'name' => 'adjuster_test',
            'label' => 'LBL_ADJUSTER',
          ),
        ),
        3 => 
        array (
          0 => 'adjuster_phone_c',
          1 => 'adjuster_email_c',
        ),
        4 => 
        array (
          0 => 'policy_number_c',
          1 => 'policy_limits',
        ),
      ),
    ),
  ),
);
