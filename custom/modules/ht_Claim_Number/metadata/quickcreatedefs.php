<?php
$module_name = 'ht_Claim_Number';
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
          0 => 
          array (
            'name' => 'account_name',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'insurance_type',
          ),
          1 => 
          array (
            'name' => 'claim_number',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'insured_c',
          ),
          1 => 
          array (
            'name' => 'adjuster',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'adjuster_phone_c',
          ),
          1 => 
          array (
            'name' => 'adjuster_email_c',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'policy_number_c',
          ),
          1 => 
          array (
            'name' => 'policy_limits',
          ),
        ),
      ),
    ),
  ),
);
