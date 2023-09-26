<?php
$module_name = 'DEF_Client_Insurance';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'includes' => 
      array (
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/clientinsurance.js',
        ),
        2 => 
        array (
          'file' => 'custom/include/javascript/visible/cliins_amounttopay.js',
        ),
        3 => 
        array (
          'file' => 'custom/include/javascript/visible/cliins_amount.js',
        ),
        4 => 
        array (
          'file' => 'custom/include/javascript/visible/cliins_case_type.js',
        ),
		5 => 
        array (
          'file' => 'custom/modules/DEF_Client_Insurance/js/getAttorneyPhone.js',
        ),
      ),
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
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
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
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
            'name' => 'claim_number',
            'label' => 'LBL_CLAIM_NUMBER',
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
            'name' => 'adjuster',
            'studio' => 'visible',
            'label' => 'LBL_ADJUSTER',
          ),
          1 => 
          array (
            'name' => 'policy_holder_c',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_HOLDER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'adjuster_phone_c',
            'label' => 'LBL_ADJUSTER_PHONE',
          ),
          1 => 
          array (
            'name' => 'adjuster_email_c',
            'label' => 'LBL_ADJUSTER_EMAIL',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'defense_attorney_c',
            'studio' => 'visible',
            'label' => 'LBL_DEFENSE_ATTORNEY',
          ),
          1 => 
          array (
            'name' => 'um_policy_number_c',
            'label' => 'LBL_UM_POLICY_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'defense_attorney_phone_c',
            'label' => 'LBL_DEFENSE_ATTORNEY_PHONE',
          ),
          1 => 
          array (
            'name' => 'defense_attorney_email_c',
            'label' => 'LBL_DEFENSE_ATTORNEY_EMAIL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'defense_attorney_2_c',
            'studio' => 'visible',
            'label' => 'LBL_DEFENSE_ATTORNEY_2',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'defense_attorney_2_phone_c',
            'label' => 'LBL_DEFENSE_ATTORNEY_2_PHONE',
          ),
          1 => 
          array (
            'name' => 'defense_attorney_2_email_c',
            'label' => 'LBL_DEFENSE_ATTORNEY_2_EMAIL',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'claim_result',
            'studio' => 'visible',
            'label' => 'LBL_CLAIM_RESULT',
          ),
          1 => 
          array (
            'name' => 'amount_recovered',
            'label' => 'LBL_AMOUNT_RECOVERED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'firm_fee',
            'label' => 'LBL_FIRM_FEE',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'def_client_insurance_cases_1_name',
            'label' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_CASES_TITLE',
            'displayParams' => 
            array (
              'call_back_function' => 'showhideCliInsFields',
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
    ),
  ),
);
