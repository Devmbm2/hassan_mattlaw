<?php
$module_name = 'ht_sms';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
		  4 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?&module=ht_sms&action=link_document&record={$fields.id.value}\')" target="_blank" value="Link To Document" />',
          ),
		  5 => 
          array (
            'customCode' => '<input type="button" onclick="window.location.replace(\'index.php?&module=ht_sms&action=update_phone_list_status&status={$STATUS}&record={$fields.id.value}\')"  value=\'{$LABEL}\' />',
          ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
		'LBL_DETAILVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
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
            'name' => 'from_number',
            'label' => 'LBL_FROM_NUMBER',
          ),
          1 => 
          array (
            'name' => 'to_number',
            'label' => 'LBL_TO_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
          1 => 
          array (
            'name' => 'message_status',
            'label' => 'LBL_MESSAGE_STATUS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'message_error_code',
            'label' => 'LBL_MESSAGE_ERROR_CODE',
          ),
          1 => '',
        ),
		6 => 
        array (
          0 => 'filename',
          1 => '',
        ),
        7 => 
        array (
          0 => 'date_entered',
          1 => 'date_modified',
        ),
      ),
	  'lbl_detailview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'sms_body',
            'label' => 'LBL_DETAILVIEW_PANEL4',
			'customCode' => '<div id = "sms_body"></div>',
          ),
        ),
      ),
    ),
  ),
);
