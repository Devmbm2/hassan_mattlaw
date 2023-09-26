<?php
$module_name = 'ht_login_tracker';
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
          0 => 'DELETE',
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
        'LBL_EDITVIEW_PANEL4' => 
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
          0 =>  
          array (
            'name' => 'ht_name',
            'label' => 'LBL_NAME',
          ),
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
            'name' => 'user_session_time',
            'label' => 'LBL_USER_WORKED_TIME',
          ),
          1 => 
          array (
            'name' => 'logout_timestamp',
            'label' => 'LBL_LOGOUT_TIMESTAMP',
          ),
        ),
        4 => 
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
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'user_agent',
            'label' => 'LBL_USER_AGENT',
          ),
          1 => '',
          // array (
          //   'name' => 'is_user_logged_out',
          //   'label' => 'LBL_IS_USER_LOGGED_OUT',
          // ),
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
			'hideLabel' => true,
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
			      'hideLabel' => true,
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'latitude_longitude',
            'customCode' =>'
              {if $fields.latitude_longitude !="" }
                <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC3Pvsk2CFTXpo3KRtlWJzsXFe64eXVpxE&q={$fields.latitude_longitude}&zoom=18" allowfullscreen></iframe>
              {else}
                <h3>Coordinates are not found.</h3>
              {/if}',
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
