<?php
$module_name = 'MEDB_Medical_Bills';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/medbill_reduction.js',
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
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
          0 => 'document_name',
          1 => 
          array (
            'name' => 'medb_medical_bills_contacts_name',
            'label' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
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
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'adjuster_id',
                'name' => 'adjuster_name',
                'phone_mobile' => 'adjuster_phone',
                'phone_fax' => 'adjuster_fax',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'case_name_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_NAME',
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
            'name' => 'pip_exhausted_c',
            'label' => 'LBL_PIP_EXHAUSTED',
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
            'name' => 'date_pip_exhausted_c',
            'label' => 'LBL_DATE_PIP_EXHAUSTED',
          ),
		   1 => 
          array (
            'name' => 'workers_comp_paid',
            'label' => 'LBL_WORKERS_COMP_PAID',
          ),
        ),
        13 => 
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
        14 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'displayParams' => 
            array (
              'rows' => 10,
              'cols' => 120,
            ),
          ),
        ),
        15 => 
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
        16 => 
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
