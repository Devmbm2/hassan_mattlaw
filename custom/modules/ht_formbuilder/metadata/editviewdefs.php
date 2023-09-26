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
	  'form' => 
      array (
        'footerTpl' => 'modules/ht_formbuilder/tpls/EditViewFooter.tpl',
		'hidden' =>
        array (
          0 => '<textarea id="description" name="description" rows="6" cols="80" title="" tabindex="0" style="width:100%;display:none;">{$fields.description.value}</textarea>',
        ),
      ),
	   'includes' => 
        array (
		   array (
			   'file' => 'modules/ht_formbuilder/js/formbuilder.js',
			 ),
			 array (
			   'file' => 'modules/ht_formbuilder/ht_formbuilder_utils.js',
			 ),
			 array (
            'file' => 'modules/ht_formbuilder/js/sweetAlert.js',
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
          0 => 
          array (
            'name' => 'related_module',
            'studio' => 'visible',
            'label' => 'LBL_RELATED_MODULE',
          ),
          1 => array (
            'name' => 'column_size',
            'label' => 'LBL_COLUMN',
          ),
        ),
		1 => 
        array (
          0 => 
      array (
            'name' => 'question_type',
            'label' => 'LBL_QUESTION_TYPE',
          ),
          1 => 
		  array (
            'name' => 'case_type',
            'label' => 'LBL_TYPE',
          ),
       2 => 
      array (
            'name' => 'case_sub_type',
            'label' => 'LBL_SUB_TYPE',
          ),
        ),
		3 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        /* 2 => 
        array (
          0 => array(
            'name' => 'description',
            //'customCode' => '{include file="modules/ht_formbuilder/tpls/BuildIntakeForm.tpl"}',
            'label' => 'LBL_DESCRIPTION',
          ),
        ), */
		/* 3 => 
        array (
          0 => array(
            'name' => 'description_html',
            'label' => 'LBL_DESCRIPTION_HTML',
			'type' => 'html',
          ),
        ), */
		
      ),
    ),
  ),
);
