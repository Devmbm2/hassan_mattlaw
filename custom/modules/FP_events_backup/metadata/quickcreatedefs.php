<?php
$module_name = 'FP_events';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/event_type.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/FP_events/js/edit.js',
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
      ),
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
            'comment' => 'Duration handler dropdown',
            'label' => 'LBL_DURATION',
            'customCode' => '
                @@FIELD@@
                <input id="duration_hours" name="duration_hours" type="hidden" value="{$fields.duration_hours.value}">
                <input id="duration_minutes" name="duration_minutes" type="hidden" value="{$fields.duration_minutes.value}">
                {sugar_getscript file="custom/modules/FP_events/duration_dependency.js"}
                <script type="text/javascript">
                    var date_time_format = "{$CALENDAR_FORMAT}";
                    {literal}
                    SUGAR.util.doWhen(function(){return typeof DurationDependency != "undefined" && typeof document.getElementById("duration") != "undefined"}, function(){
                        var duration_dependency = new DurationDependency("date_start","date_end","duration",date_time_format);
                        initEditView(YAHOO.util.Selector.query(\'select#duration\')[0].form);
                    });
                    {/literal}
                </script>            
            ',
            'customCodeReadOnly' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV} ',
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
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'cancelled_reset_c',
            'studio' => 'visible',
            'label' => 'LBL_CANCELLED_RESET',
          ),
          /* 1 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ), */
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
          1 => 'assigned_user_name',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
            /* 'customCode' => '{html_options name="multiple_assigned_users[]" multiple="multiple" id="multiple_assigned_users" options=$fields.multiple_assigned_users.options selected=$fields.assigned_user_id.value}', */
          ),
          1 => 
          array (
            'name' => 'cases_fp_events_1_name',
            'label' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
			'displayParams' => array(
				'call_back_function'=>'updateRelatedAssignedTo',
			),
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
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
      ),
    ),
  ),
);
