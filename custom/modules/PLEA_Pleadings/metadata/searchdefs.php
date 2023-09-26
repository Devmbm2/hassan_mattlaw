<?php
$module_name = 'PLEA_Pleadings';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'pleading_name_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PLEADING_NAME',
        'width' => '10%',
        'name' => 'pleading_name_c',
      ),
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'plea_pleadings_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
        'width' => '10%',
        'default' => true,
        'id' => 'PLEA_PLEADINGS_CASESCASES_IDA',
        'name' => 'plea_pleadings_cases_name',
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
      'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'pleading_name_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PLEADING_NAME',
        'width' => '10%',
        'name' => 'pleading_name_c',
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
      'active_date' => 
      array (
        'name' => 'active_date',
        'default' => true,
        'width' => '10%',
      ),
      'outgoing_document' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_OUTGOING_DOCUMENT',
        'width' => '10%',
        'name' => 'outgoing_document',
      ),
      'done_holder_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_DONE_HOLDER',
        'width' => '10%',
        'name' => 'done_holder_c',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
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
      'incoming_or_outgoing' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_INCOMING_OR_OUTGOING',
        'width' => '10%',
        'default' => true,
        'name' => 'incoming_or_outgoing',
      ),
      'plea_pleadings_cases_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
        'id' => 'PLEA_PLEADINGS_CASESCASES_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'plea_pleadings_cases_name',
      ),
      'case_type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type_c',
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
