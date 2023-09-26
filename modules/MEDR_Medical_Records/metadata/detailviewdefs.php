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
            'name' => 'medr_medical_records_contacts_name',
          ),
          1 => 'uploadfile',
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
            'name' => 'date_range_start',
            'label' => 'LBL_DATE_RANGE_START',
          ),
          1 => 
          array (
            'name' => 'date_range_end',
            'label' => 'LBL_DATE_RANGE_END',
          ),
        ),
        4 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'secret_notes',
            'studio' => 'visible',
            'label' => 'LBL_SECRET_NOTES',
          ),
        ),
        5 => 
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
