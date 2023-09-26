<?php
$module_name = 'COST_Client_Cost';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'companion' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_COMPANION',
        'id' => 'CONTACT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'companion',
      ),
      'invoice_number' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_INVOICE_NUMBER',
        'width' => '10%',
        'default' => true,
        'name' => 'invoice_number',
      ),
      'type' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'type',
      ),
      'cost_client_cost_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
        'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'cost_client_cost_cases_name',
      ),
      'total_amount' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_TOTAL_AMOUNT',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'total_amount',
      ),
    ),
    'advanced_search' => 
    array (
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'studio' => 'visible',
        'label' => 'LBL_FLEX_RELATE',
        'link' => true,
        'sortable' => false,
        'ACLTag' => 'PARENT',
        'dynamic_module' => 'PARENT_TYPE',
        'id' => 'PARENT_ID',
        'related_fields' => 
        array (
          0 => 'parent_id',
          1 => 'parent_type',
        ),
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),
      'cost_client_cost_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_COST_CLIENT_COST_CASES_FROM_CASES_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'COST_CLIENT_COST_CASESCASES_IDA',
        'name' => 'cost_client_cost_cases_name',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'companion' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_COMPANION',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'id' => 'CONTACT_ID_C',
        'name' => 'companion',
      ),
      'total_amount' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_TOTAL_AMOUNT',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'total_amount',
      ),
      'paid_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_PAID_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'paid_date',
      ),
      'case_type' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type',
      ),
      'case_assigned_to_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CASE_ASSIGNED_TO',
        'id' => 'USER_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'case_assigned_to_c',
      ),
      'assigned_lawyer_cases' => 
      array (
        'name' => 'assigned_lawyer_cases',
        'label' => 'LBL_ASSIGNED_LAWYER_CASES',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'assigned_lawyer_cases_list',
        'default' => true,
      ),
      'case_status' => 
      array (
        'name' => 'case_status',
        'label' => 'LBL_CASE_STATUS',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'case_status_dom',
        'default' => true,
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'date_modified' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_modified',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
