<?php
$module_name = 'ht_formbuilder';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
		'hidden' =>
        array (
          0 => '<textarea id="description" name="description" rows="6" cols="80" title="" tabindex="0" style="width:100%;display:none;">{$fields.description.value}</textarea>',
        ),
	  
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
		
      ),
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
			   'file' => 'modules/ht_formbuilder/js/hide.js',
			 ),
			 /* 0 => 
        array (
          'file' => 'modules/ht_formbuilder/js/formbuilder.js',
        ),
		1 => 
        array (
          'file' => 'modules/ht_formbuilder/js/hide.js',
        ),   */
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
          1 => 'date_entered',
        ),
        /* 2 => 
        array (
          0 => 'description',
		  
        ), */
		2 => 
        array (
          0 => 
		  array (
            'name' => 'case_type',
            'label' => 'LBL_TYPE',
          ),
      1 => array (
            'name' => 'question_type',
            'label' => 'LBL_QUESTION_TYPE',
          ),
		 2 => array (
            'name' => 'column_size',
            'label' => 'LBL_COLUMN',
          ),
          
        ),
		3 => 
        array (
          0 => 
		  array( 
		  'name' => 'description_html',
		  'customCode' => '{include file="modules/ht_formbuilder/tpls/BuildIntakeForm.tpl"}',
		  ),
        ),
		
		
      ),
    ),
  ),
);
