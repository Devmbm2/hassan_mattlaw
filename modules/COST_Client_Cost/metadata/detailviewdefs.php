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
          1 => 'uploadfile',
        ),
        1 => 
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
        2 => 
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
        3 => 
        array (
          0 => 
          array (
            'name' => 'payee',
            'studio' => 'visible',
            'label' => 'LBL_PAYEE',
          ),
          1 => 
          array (
            'name' => 'invoice_number',
            'label' => 'LBL_INVOICE_NUMBER',
          ),
        ),
        4 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'paid_date',
            'label' => 'LBL_PAID_DATE',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'cost_client_cost_cases_name',
          ),
        ),
        7 => 
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
      ),
    ),
  ),
);
?>
