<?php
$module_name = 'ht_vehicles';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
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
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'vin_number',
            'label' => 'LBL_VIN_NUMBER',
          ),
        ),
		1 => 
        array (
          0 => 'vehicle_no',
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'vehicle_license_plate_number',
            'label' => 'LBL_VEHICLE_LICENSE_PLATE_NUMBER',
          ),
          1 => 
          array (
            'name' => 'vehicle_type',
            'studio' => 'visible',
            'label' => 'LBL_VEHICLE_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'vehicle_make',
            'label' => 'LBL_VEHICLE_MAKE',
          ),
          1 => 
          array (
            'name' => 'vehicle_year',
            'label' => 'LBL_VEHICLE_YEAR',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'vehicle_color',
            'label' => 'LBL_VEHICLE_COLOR',
          ),
          // 1 => 'created_by',
        ),
        5 => 
        array (
          0 => 'ht_vehicles_cases_1_name',
          1 => 'description',
        ),
      ),
    ),
  ),
);
