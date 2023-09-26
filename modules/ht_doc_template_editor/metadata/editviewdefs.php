<?php
$module_name = 'ht_doc_template_editor';
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
	  'includes' => 
       array (
			array (
			  'file' => 'modules/DHA_PlantillasDocumentos/librerias/ckeditor5/ckeditor.js',
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
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'module_name',
            'studio' => 'visible',
            'label' => 'LBL_MODULE_NAME',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
