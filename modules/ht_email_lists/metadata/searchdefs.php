<?php
$module_name = 'ht_email_lists';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
		'label' => 'LBL_SUBJECT',
        'default' => true,
        'width' => '20%',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_LIST_RELATED_TO',
        'width' => '20%',
        'default' => true,
        'name' => 'parent_name',
      ),	
	  'date_sent' => 
	  array (
		'name' => 'date_sent',
		'type' => 'date',
		), 
    ),
    'advanced_search' => 
    array (
      0 => 'name',
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_LIST_RELATED_TO',
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
      ),	
	  'date_sent' => 
	  array (
		'name' => 'date_sent',
		'type' => 'date',
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
?>
