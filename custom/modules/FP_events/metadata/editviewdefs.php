<?php
$module_name = 'FP_events';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
        'enctype' => 'multipart/form-data',
      ),
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
        2 => 
        array (
          'file' => 'custom/modules/Calendar/events.js',
        ),
        3 => 
        array (
          'file' => 'custom/modules/FP_events/js/editview.js',
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
        'LBL_EDITVIEW_ATTACHMENT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
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
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'event_type',
            'label' => 'LBL_EVENT_TYPE',
          ),
        ),
        2 => 
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
        3 => 
        array (
          0 => 'description',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'cancelled_reset_c',
            'studio' => 'visible',
            'label' => 'LBL_CANCELLED_RESET',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'court_reporter_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_REPORTER',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'cases_fp_events_1_name',
            'label' => 'LBL_CASES_FP_EVENTS_1_FROM_CASES_TITLE',
          ),
          1 => 
          array (
            'name' => 'multiple_assigned_users',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'filename',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'date_end',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'duration',
            'customCode' => '
                @@FIELD@@
                <input id="duration_hours" name="duration_hours" type="hidden" value="{$fields.duration_hours.value}">
                <input id="duration_minutes" name="duration_minutes" type="hidden" value="{$fields.duration_minutes.value}">
                {sugar_getscript file="custom/modules/FP_events/duration_dependency.js"}
                <script type="text/javascript">
                    var date_time_format = "{$CALENDAR_FORMAT}";
                    {literal}
                    SUGAR.util.doWhen(function(){return typeof DurationDependency != "undefined" && typeof document.getElementById("duration") != "undefined" && $("#date_start_date").val() != "" && $("#date_end_date").val() != ""}, function(){
                        var duration_dependency = new DurationDependency("date_start","date_end","duration",date_time_format);
                        initEditView(YAHOO.util.Selector.query(\'select#duration\')[0].form);
                    });
                    {/literal}
                </script>            
            ',
            'customCodeReadOnly' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV} ',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'hold_dates',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'meeting_id',
            'label' => 'LBL_MEETING_ID',
          ),
          1 => 
          array (
            'name' => 'meeting_password',
            'label' => 'LBL_MEETING_PASSWORD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'meeting_url',
            'label' => 'LBL_MEETING_URL',
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
            'type' => 'text',
            'width' => '45%',
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
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'attorney1',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY1',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id2_c',
                'name' => 'attorney1',
                'phone_work' => 'attorney1_phone',
              ),
            ),
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
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id3_c',
                'name' => 'attorney2',
                'phone_work' => 'attorney2_phone',
              ),
            ),
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
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id4_c',
                'name' => 'attorney3',
                'phone_work' => 'attorney3_phone',
              ),
            ),
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
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id5_c',
                'name' => 'attorney4',
                'phone_work' => 'attorney4_phone',
              ),
            ),
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
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id6_c',
                'name' => 'attorney5',
                'phone_work' => 'attorney5_phone',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'attorney5_phone',
            'label' => 'LBL_ATTORNEY5_PHONE',
          ),
        ),
      ),
      'lbl_editview_attachment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'attachments',
            'type' => 'FileUpload',
          ),
        ),
      ),
    ),
  ),
);
