<?php
$module_name = 'AOK_KnowledgeBase';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
	 'form' => 
      array (
		'enctype'=> 'multipart/form-data',
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'category_c',
            'studio' => 'visible',
            'label' => 'LBL_CATEGORY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'link_to_tutorial_c',
            'label' => 'LBL_LINK_TO_TUTORIAL',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'studio' => 'visible',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'author',
            'studio' => 'visible',
            'label' => 'LBL_AUTHOR',
          ),
          1 => 
          array (
            'name' => 'upload_file_c',
            'studio' => 'visible',
            'label' => 'LBL_UPLOAD_FILE',
          ),
        ),
      ),
    ),
  ),
);
