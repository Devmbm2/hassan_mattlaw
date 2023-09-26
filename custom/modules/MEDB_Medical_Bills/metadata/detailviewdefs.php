<?php
$module_name = 'MEDB_Medical_Bills';
$_object_name = 'medb_medical_bills';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
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
          0 => 
          array (
            'name' => 'medb_medical_bills_contacts_name',
          ),
          1 => 
          array (
            'name' => 'case_name_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'medical_provider',
            'label' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_ACCOUNTS_TITLE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'adjuster_name',
            'label' => 'LBL_ADJUSTER_NAME',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'adjuster_phone',
            'label' => 'LBL_ADJUSTER_PHONE',
          ),
          1 => 
          array (
            'name' => 'adjuster_fax',
            'label' => 'LBL_ADJUSTER_FAX',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'claim_number',
            'label' => 'LBL_CLAIM_NUMBER',
          ),
          1 => 
          array (
            'name' => 'limits',
            'label' => 'LBL_LIMITS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'total_charges',
            'label' => 'LBL_TOTAL_CHARGES',
          ),
          1 => 
          array (
            'name' => 'client_paid',
            'label' => 'LBL_CLIENT_PAID',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'write_offs_c',
            'label' => 'LBL_WRITE_OFFS',
          ),
          1 => 
          array (
            'name' => 'copy_charges',
            'label' => 'LBL_COPY_CHARGES',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'pip_paid',
            'label' => 'LBL_PIP_PAID',
          ),
          1 => 
          array (
            'name' => 'medicare_paid',
            'label' => 'LBL_MEDICARE_PAID',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'medicaid_paid',
            'label' => 'LBL_MEDICAID_PAID',
          ),
          1 => 
          array (
            'name' => 'adjustments',
            'label' => 'LBL_ADJUSTMENTS',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'health_insurance_paid',
            'label' => 'LBL_HEALTH_INSURANCE_PAID',
          ),
          1 => 
          array (
            'name' => 'interest_c',
            'label' => 'LBL_INTEREST',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'reduction_amount',
            'label' => 'LBL_REDUCTION_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'reduction_approved_by',
            'label' => 'LBL_REDUCTION_APPROVED_BY',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'workers_comp_paid',
            'label' => 'LBL_WORKERS_COMP_PAID',
          ),
          1 => 
          array (
            'name' => 'penalties_c',
            'label' => 'LBL_PENALTIES',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'balance',
            'label' => 'LBL_BALANCE',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'pip_exhausted_c',
            'label' => 'LBL_PIP_EXHAUSTED',
          ),
          1 => 
          array (
            'name' => 'date_pip_exhausted_c',
            'label' => 'LBL_DATE_PIP_EXHAUSTED',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'travel_c',
            'label' => 'LBL_TRAVEL',
          ),
          1 => 
          array (
            'name' => 'wages_c',
            'label' => 'LBL_WAGES',
          ),
        ),
        15 => 
        array (
          0 => 'description',
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'medicaid_date_c',
            'label' => 'LBL_MEDICAID_DATE',
          ),
          1 => 
          array (
            'name' => 'medicaid_id_number_c',
            'label' => 'LBL_MEDICAID_ID_NUMBER',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'medicare_type_c',
            'label' => 'LBL_MEDICARE_TYPE',
          ),
        ),
      ),
    ),
  ),
);
