<?php
$viewdefs ['Calls'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Reminders/Reminders.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Calls/js/edit.js',
        ),
		2 => 
        array (
          'file' => 'custom/modules/Calls/js/QuickCreate.js',
        ),
      ),
      'maxColumns' => '2',
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
          1 => '<input type="hidden" name="send_invites">',
          2 => '<input type="hidden" name="user_invitees">',
          3 => '<input type="hidden" name="lead_invitees">',
          4 => '<input type="hidden" name="contact_invitees">',
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
      'javascript' => '<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}<script>toggle_portal_flag();function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CALL_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_call_information' => 
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
              'updateCallback' => 'SugarWidgetScheduler.update_time();',
            ),
            'label' => 'LBL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'duration_hours',
            'label' => 'LBL_DURATION',
            'customCode' => '{literal}<script type="text/javascript">function isValidDuration() { form = document.getElementById(\'EditView\'); if ( form.duration_hours.value + form.duration_minutes.value <= 0 ) { alert(\'{/literal}{$MOD.NOTICE_DURATION_TIME}{literal}\'); return false; } return true; }</script>{/literal}<input id="duration_hours" name="duration_hours" tabindex="1" size="2" maxlength="2" type="text" value="{$fields.duration_hours.value}" onkeyup="SugarWidgetScheduler.update_time();"/>{$fields.duration_minutes.value}&nbsp;<span class="dateFormat">{$MOD.LBL_HOURS_MINUTES}',
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
            'name' => 'call_type_c',
            'studio' => 'visible',
            'label' => 'LBL_CALL_TYPE',
          ),
          1 => 
          array (
            'name' => 'select_related_caller_record_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECT_RELATED_CALLER_RECORD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'call_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_CALL_CONTACT',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'contact_id_c',
                'mt_full_name' => 'call_contact_c',
                'phone_mobile' => 'caller_number_c',
                'phone_work' => 'caller_office_phone_c',
              ),
              'call_back_function' => 'updateRelatedFields',
            ),
          ),
          1 => 
          array (
            'name' => 'caller_number_c',
            'label' => 'LBL_CALLER_NUMBER',
          ),
        ),
		4 => 
        array (
          0 => 
          array (
            'name' => 'caller_account_name',
            'studio' => 'visible',
            'label' => 'LBL_CALLER_ACCOUNT_NAME',
          ),
          1 => '',
        ),
        5 => 
        array (
		 0 => 
          array (
            'name' => 'contact_role',
            'label' => 'LBL_CONTACT_CASE_ROLE',
          ),
          1 => 
          array (
            'name' => 'caller_office_phone_c',
            'label' => 'LBL_CALLER_OFFICE_PHONE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
            'customCode' => '{html_options name="multiple_assigned_users[]" multiple="multiple" id="multiple_assigned_users" options=$fields.multiple_assigned_users.options selected=$fields.assigned_user_id.value}',
          ),
          1 => 
          array (
            'name' => 'user_id',
            'customCode' => '<input type="hidden" name="assigned_user_id" id="assigned_user_id" value="{$fields.assigned_user_id.value}">',
          ),
        ),
      ),
    ),
  ),
);
