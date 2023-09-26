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
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'document_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'medb_medical_bills_contacts_name',
          ),
          1 => 'status',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'medical_provider',
            'studio' => 'visible',
            'label' => 'LBL_MEDICAL_PROVIDER',
          ),
          1 => 
          array (
            'name' => 'lop_lien',
            'label' => 'LBL_LOP_LIEN',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'total_charges',
            'label' => 'LBL_TOTAL_CHARGES',
          ),
          1 => 
          array (
            'name' => 'balance',
            'label' => 'LBL_BALANCE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'copy_charges',
            'label' => 'LBL_COPY_CHARGES',
          ),
          1 => 
          array (
            'name' => 'amount_jury_sees',
            'label' => 'LBL_AMOUNT_JURY_SEES',
          ),
        ),
        5 => 
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
        6 => 
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
        7 => 
        array (
          0 => 
          array (
            'name' => 'health_insurance_paid',
            'label' => 'LBL_HEALTH_INSURANCE_PAID',
          ),
          1 => 
          array (
            'name' => 'client_paid',
            'label' => 'LBL_CLIENT_PAID',
          ),
        ),
        8 => 
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
        9 => 
        array (
          0 => 'description',
          1 => 'uploadfile',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'comment' => 'Date record last modified',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'modified_by_name',
            'label' => 'LBL_MODIFIED_NAME',
          ),
        ),
      ),
    ),
  ),
);
?>
