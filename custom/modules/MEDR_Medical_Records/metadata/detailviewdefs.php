<?php
$module_name = 'MEDR_Medical_Records';
$_object_name = 'medr_medical_records';
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
            'name' => 'contact_name',
            'label' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status_id',
            'label' => 'LBL_DOC_STATUS',
          ),
          1 => 
          array (
            'name' => 'med_summary_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MED_SUMMARY_STATUS',
          ),
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
            'name' => 'name_of_doctor',
            'label' => 'LBL_NAME_OF_DOCTOR',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'range_of_records_requested_c',
            'studio' => 'visible',
            'label' => 'LBL_RANGE_OF_RECORDS_REQUESTED',
          ),
          1 => 'uploadfile',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_range_start',
            'label' => 'LBL_DATE_RANGE_START',
          ),
          1 => 
          array (
            'name' => 'date_range_end',
            'label' => 'LBL_DATE_RANGE_END',
          ),
        ),
        5 => 
        array (
          0 => 'description',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'how_many_pages_c',
            'label' => 'LBL_HOW_MANY_PAGES',
          ),
          1 => 
          array (
            'name' => 'record_req_problems_c',
            'studio' => 'visible',
            'label' => 'LBL_RECORD_REQ_PROBLEMS',
          ),
        ),
        7 => 
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
