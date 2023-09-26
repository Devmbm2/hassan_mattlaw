<?php
$module_name = 'COST_Client_Cost';
$_object_name = 'cost_client_cost';
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/client_cost_type.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/client_cost_status.js',
        ),
        2 => 
        array (
          'file' => 'custom/modules/COST_Client_Cost/js/client_cost_case_type.js',
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
        'LBL_DETAILVIEW_PANEL1' => 
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
          0 => 'document_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'payee',
            'studio' => 'visible',
            'label' => 'LBL_PAYEE',
          ),
          1 => 'uploadfile',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
          1 => 
          array (
            'name' => 'number_of_ways_to_split',
            'studio' => 'visible',
            'label' => 'LBL_NUMBER_OF_WAYS_TO_SPLIT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'total_amount',
            'label' => 'LBL_TOTAL_AMOUNT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'invoice_number',
            'label' => 'LBL_INVOICE_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'paid_date',
            'label' => 'LBL_PAID_DATE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'deponent',
            'studio' => 'visible',
            'label' => 'LBL_DEPONENT',
          ),
          1 => 
          array (
            'name' => 'check_number',
            'label' => 'LBL_CHECK_NUMBER',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'cost_client_cost_cases_name',
          ),
        ),
        8 => 
        array (
          0 => 'description',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'case_type_c',
            'label' => 'LBL_CASE_TYPE',
          ),
          1 => 
          array (
            'name' => 'case_status_c',
            'label' => 'LBL_CASE_STATUS',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'case_assigned_to_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_ASSIGNED_TO',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
      ),
      'lbl_detailview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'recovery_of_costs',
            'studio' => 'visible',
            'label' => 'LBL_RECOVERY_OF_COSTS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'lost_unreimbursed_costs',
            'label' => 'LBL_LOST_UNREIMBURSED_COSTS',
          ),
        ),
      ),
    ),
  ),
);
