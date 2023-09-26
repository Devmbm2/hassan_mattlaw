<?php
$module_name = 'COMP_Companions';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/comp_case_type.js',
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
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id_c',
                'name' => 'companion',
                'age_c' => 'age',
                'total_lops_liens_c' => 'total_lops_liens',
                'total_medical_bills_c' => 'total_medical_bills',
              ),
              'additionalFields' => 
              array (
                'age_c' => 'age',
                'total_lops_liens_c' => 'total_lops_liens',
                'total_medical_bills_c' => 'total_medical_bills',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'relationship_to_main_client',
            'studio' => 'visible',
            'label' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
          ),
        ),
        1 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'comp_companions_cases_name',
            'label' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'comp_companions_casescases_ida',
                'name' => 'comp_companions_cases_name',
                'type' => 'case_type_c',
                'status' => 'case_status_c',
              ),
              'additionalFields' => 
              array (
                'type' => 'case_type_c',
                'status' => 'case_status_c',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
