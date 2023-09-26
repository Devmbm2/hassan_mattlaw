<?php
$module_name = 'ht_login_tracker';
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
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
        ),
        1 => 
        array (
          0 => 'description',
        ),
        2 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'login_timestamp',
            'label' => 'LBL_LOGIN_TIMESTAMP',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'ip_address',
            'label' => 'LBL_IP_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'browser',
            'label' => 'LBL_BROWSER',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'device',
            'label' => 'LBL_DEVICE',
          ),
          1 => 
          array (
            'name' => 'operating_system',
            'label' => 'LBL_OPERATING_SYSTEM',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'user_agent',
            'label' => 'LBL_USER_AGENT',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'server_information',
            'studio' => 'visible',
            'label' => 'LBL_SERVER_INFORMATION',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'browser_information',
            'studio' => 'visible',
            'label' => 'LBL_BROWSER_INFORMATION',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value}',
          ),
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value}',
          ),
        ),
      ),
    ),
  ),
);
;
?>
