<?php
$module_name = 'ht_formbuilder';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
	
      'maxColumns' => '1',
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
			   'file' => 'modules/ht_formbuilder/js/formbuilder.js',
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
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'related_module',
            'studio' => 'visible',
            'label' => 'LBL_RELATED_MODULE',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => array(
            'name' => 'description',
            //'customCode' => '{include file="modules/ht_formbuilder/tpls/BuildIntakeForm.tpl"}',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
		
      ),
    ),
  ),
);
