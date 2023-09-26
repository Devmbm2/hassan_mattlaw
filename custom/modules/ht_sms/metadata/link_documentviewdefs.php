<?php
$module_name = 'ht_sms';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
	 'form' =>
      array (
	   'buttons' => 
	   array(
		0 => array( 'customCode' => '<input type="button" value="Save" onclick="save_document();" />'),
		1 => 'CANCEL',
	   ),
	   'hideAudit' => false,
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
        'LBL_LINK_DOCUMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'LBL_LINK_DOCUMENT' => 
      array (
		0 => 
        array (
          0 => 
          array (
            'name' => 'file_name',
			'label' => 'LBL_FILE_NAME',
          ),
        ),	
		1 => 
        array (
		  0 => 
          array (
            'name' => 'parent_name',
			'label' => 'LBL_RELATED_TO',
          ),
        ),
      ),
    ),
  ),
);
?>
