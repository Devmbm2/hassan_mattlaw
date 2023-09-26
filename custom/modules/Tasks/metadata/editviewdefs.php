<?php
$viewdefs ['Tasks'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '{if $fields.status.value != "Completed"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" class="button" onclick="document.getElementById(\'status\').value=\'Completed\'; this.form.action.value=\'Save\'; this.form.return_module.value=\'Tasks\'; this.form.isDuplicate.value=true; this.form.isSaveAndNew.value=true; this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'; if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(this.form);" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
        'enctype' => 'multipart/form-data',
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
        'LBL_TASK_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_TASK_MEDR_RECORD' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_task_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'type_of_todo_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE_OF_TODO',
          ),
          1 => 
          array (
            'name' => 'time_spent_c',
            'label' => 'LBL_TIME_SPENT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'status',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_due',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'extend_date_c',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'reasons_c',
            'label' => 'LBL_REASONS',
          ),
          1 => 
          array (
            'name' => 'reason_on_selected_other_option_c',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
          1 => 
          array (
            'name' => 'contact_name',
            'label' => 'LBL_CONTACT_NAME',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
          1 => 
          array (
            'name' => 'task_file_c',
            'label' => 'LBL_TASK_FILE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
          1 => 
          array (
            'name' => 'team_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAM',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'request_types_c',
            'studio' => 'visible',
            'label' => 'LBL_REQUEST_TYPES',
          ),
          1 => 
          array (
            'name' => 'mreq_medb_requests_tasks_1_name',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'mreq_medb_requests_activities_1_tasks_name',
          ),
          1 => 
          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' => 
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'disc_discovery_activities_1_tasks_name',
          ),
        ),
      ),
      'lbl_task_medr_record' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name_of_doctor_c',
            'studio' => 'visible',
            'label' => 'LBL_NAME_OF_DOCTOR',
            'displayParams' => 
        array (
          'initial_filter' => '',
            ),
          ),
          1 => 
          array (
            'name' => 'date_range_med_rec_requested_c',
            'studio' => 'visible',
            'label' => 'LBL_DATE_RANGE_MED_REC_REQUESTED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'beginning_date_range_of_reco_c',
            'label' => 'LBL_BEGINNING_DATE_RANGE_OF_RECO',
          ),
          1 => 
          array (
            'name' => 'end_date_of_med_rec_requeste_c',
            'label' => 'LBL_END_DATE_OF_MED_REC_REQUESTE',
          ),
        ),
      ),
    ),
  ),
);
