<?php
$module_name = 'FP_events';
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
          4 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="window.open(\'index.php?module=FP_events&record_id={$fields.id.value}&action=view_week\',\'_self\')" target="_blank" value="View Week">',
          ),
          5 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="window.open(\'index.php?module=FP_events&record_id={$fields.id.value}&action=view_month\',\'_self\')" target="_blank" value="View Month">',
          ),
        ),
        'hidden' => 
        array (
          0 => '<input id="custom_hidden_1" type="hidden" name="custom_hidden_1" value=""/>',
          1 => '<input id="custom_hidden_2" type="hidden" name="custom_hidden_2" value=""/>',
          2 => '<input type="hidden" name="status" value="">',
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'include/javascript/checkbox.js',
        ),
        1 => 
        array (
          'file' => 'cache/include/javascript/sugar_grp_yui_widgets.js',
        ),
        2 => 
        array (
          'file' => 'custom/include/javascript/visible/event_type.js',
        ),
      ),
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
        'LBL_PANEL_OVERVIEW' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_PANEL_OVERVIEW' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'comment' => 'Date of start of meeting',
            'label' => 'LBL_DATE',
          ),
          1 => 
          array (
            'name' => 'date_end',
            'comment' => 'Date meeting ends',
            'label' => 'LBL_DATE_END',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'duration',
            'customCode' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV} ',
            'label' => 'LBL_DURATION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'travel_start_c',
            'label' => 'LBL_TRAVEL_START',
          ),
          1 => 
          array (
            'name' => 'travel_end_c',
            'label' => 'LBL_TRAVEL_END',
          ),
        ),
        4 => 
        array (
          0 => 'description',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'cancelled_reset_c',
            'studio' => 'visible',
            'label' => 'LBL_CANCELLED_RESET',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'deponent_c',
            'studio' => 'visible',
            'label' => 'LBL_DEPONENT',
          ),
          1 => 
          array (
            'name' => 'videographer_c',
            'studio' => 'visible',
            'label' => 'LBL_VIDEOGRAPHER',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'court_reporter_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_REPORTER',
          ),
          1 => 
          array (
            'name' => 'cases_fp_events_1_name',
            'label' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_LOCATION_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_at_location_of_event_c',
            'label' => 'LBL_PHONE_AT_LOCATION_OF_EVENT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'comment' => 'Street address for primary address',
            'label' => 'LBL_PRIMARY_ADDRESS_STREET',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'location_address_city_c',
            'label' => 'LBL_LOCATION_ADDRESS_CITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'location_address_state_c',
            'label' => 'LBL_LOCATION_ADDRESS_STATE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'location_address_postalcode_c',
            'label' => 'LBL_LOCATION_ADDRESS_POSTALCODE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
      ),
      'lbl_detailview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'attorney1',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY1',
          ),
          1 => 
          array (
            'name' => 'attorney1_phone',
            'label' => 'LBL_ATTORNEY1_PHONE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'attorney2',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY2',
          ),
          1 => 
          array (
            'name' => 'attorney2_phone',
            'label' => 'LBL_ATTORNEY2_PHONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'attorney3',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY3',
          ),
          1 => 
          array (
            'name' => 'attorney3_phone',
            'label' => 'LBL_ATTORNEY3_PHONE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'attorney4',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY4',
          ),
          1 => 
          array (
            'name' => 'attorney4_phone',
            'label' => 'LBL_ATTORNEY4_PHONE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'attorney5',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY5',
          ),
          1 => 
          array (
            'name' => 'attorney5_phone',
            'label' => 'LBL_ATTORNEY5_PHONE',
          ),
        ),
      ),
    ),
  ),
);
