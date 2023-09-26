<?php
$module_name = 'DISC_Discovery';
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
      'assigned_lawyer_cases' => 
      array (
        'name' => 'assigned_lawyer_cases',
        'label' => 'LBL_ASSIGNED_LAWYER_CASES',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'assigned_lawyer_cases_list',
      ),
    ),
    'advanced_search' => 
    array (
      'date_modified' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_modified',
      ),
      'modified_user_id' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_MODIFIED',
        'width' => '10%',
        'default' => true,
        'name' => 'modified_user_id',
      ),
      'created_by' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_CREATED',
        'width' => '10%',
        'default' => true,
        'name' => 'created_by',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'disc_discovery_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
        'id' => 'DISC_DISCOVERY_CASESCASES_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'disc_discovery_cases_name',
      ),
      'case_type_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type_c',
      ),
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'category_id' => 
      array (
        'name' => 'category_id',
        'default' => true,
        'width' => '10%',
      ),
      'subcategory_id' => 
      array (
        'name' => 'subcategory_id',
        'default' => true,
        'width' => '10%',
      ),
      'done_holder_discovery_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_DONE_HOLDER_DISCOVERY',
        'width' => '10%',
        'name' => 'done_holder_discovery_c',
      ),
      'to_from' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_TO_FROM',
        'id' => 'ACCOUNT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'to_from',
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
      'status' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
      'status_id' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_DOC_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status_id',
      ),
      'next_step' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_NEXT_STEP',
        'width' => '10%',
        'default' => true,
        'name' => 'next_step',
      ),
      'done' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_DONE',
        'width' => '10%',
        'name' => 'done',
      ),
      'sent_received' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SENT_RECEIVED',
        'width' => '10%',
        'default' => true,
        'name' => 'sent_received',
      ),
      'active_date' => 
      array (
        'name' => 'active_date',
        'default' => true,
        'width' => '10%',
      ),
      'exp_date' => 
      array (
        'name' => 'exp_date',
        'default' => true,
        'width' => '10%',
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
