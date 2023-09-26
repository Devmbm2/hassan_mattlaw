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
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/defendants.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/defendant_case_type.js',
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
        'LBL_EDITVIEW_PANEL4' => 
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
            'name' => 'defendant_organization_c',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT_ORGANIZATION',
          ),
          1 => 
          array (
            'name' => 'defendant_organization_type_c',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT_ORGANIZATION_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'date_of_incident',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'case_type_c',
            'label' => 'LBL_CASE_TYPE',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
          1 => 
          array (
            'name' => 'policy_type',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'insured_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURED',
          ),
          1 => '',
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
            'name' => 'policy_number_c',
            'label' => 'LBL_POLICY_NUMBER',
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
      'lbl_editview_panel2' => 
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
            'name' => 'acase_name',
            'studio' => 'visible',
            'label' => 'LBL_ACASE_NAME',
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
      'lbl_editview_panel3' => 
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
            'name' => 'amount_recovered_c',
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
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 'description',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
      ),
    ),
  ),
);
