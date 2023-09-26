<?php
$module_name = 'DISC_Discovery';
$_object_name = 'disc_discovery';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '<input type="button" onclick="mark_done(\'{$fields.id.value}\', \'DISC_Discovery\' );" value="Mark Done" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="mark_done_notify(\'{$fields.id.value}\', \'DISC_Discovery\' );" value="Mark Done & Notify" />',
          ),
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/discovery_case_type.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Documents/js/detail.js',
        ),
        2 => 
        array (
          'file' => 'custom/modules/DISC_Discovery/js/document_memo.js',
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
        'DEFAULT' => 
        array (
          'newTab' => true,
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
          0 => 'document_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_served',
            'label' => 'LBL_DATE_SERVED',
          ),
          1 => 
          array (
            'name' => 'response_date',
            'label' => 'LBL_RESPONSE_DATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'author_type',
            'label' => 'LBL_AUTHOR_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'disc_discovery_cases_name',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
          1 => '',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'q_a',
            'studio' => 'visible',
            'label' => 'LBL_Q_A',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'OneTwoFourthDropdownField',
            'label' => 'LBL_ONETWOFOURTHDROPDOWNFIELD',
          ),
          1 => 
          array (
            'name' => 'witness_type_c',
            'studio' => 'visible',
            'label' => 'LBL_WITNESS_TYPE',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'witness_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_WITNESS_CONTACT',
          ),
          1 => 
          array (
            'name' => 'witness_organization_c',
            'studio' => 'visible',
            'label' => 'LBL_WITNESS_ORGANIZATION',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'witness_nickname_c',
            'label' => 'LBL_WITNESS_NICKNAME',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'delivery_method_c',
            'studio' => 'visible',
            'label' => 'LBL_DELIVERY_METHOD',
          ),
          1 => 
          array (
            'name' => 'day_counter_c',
            'label' => 'LBL_DAY_COUNTER',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'done',
            'label' => 'LBL_DONE',
          ),
          1 => 
          array (
            'name' => 'document_processed_description',
            'label' => 'LBL_DOCUMENT_PROCESSED_DESCRIPTION',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'discovery_description',
            'label' => 'LBL_DISCOVERY_DESCRIPTION',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 'uploadfile',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'add_workflow_c',
            'studio' => 'visible',
            'label' => 'LBL_ADD_WORKFLOW',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'discovery_matrix_c',
            'label' => 'LBL_DISCOVERY_MATRIX',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'hd_reviewed_by_name',
            'studio' => 'visible',
            'label' => 'LBL_HD_REVIEWED_BY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'qc1_reviewed_c',
            'studio' => 'visible',
            'label' => 'LBL_QC1_REVIEWED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'qc1_reason_for_fail_c',
            'studio' => 'visible',
            'label' => 'LBL_QC1_REASON_FOR_FAIL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'assistant_reviewed_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSISTANT_REVIEWED',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'assistant_reason_for_fail_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSISTANT_REASON_FOR_FAIL',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'qc_review_remarks_c',
            'studio' => 'visible',
            'label' => 'LBL_QC_REVIEW_REMARKS',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_lawyer_1_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSIGNED_LAWYER_1',
          ),
          1 => 
          array (
            'name' => 'lawyer_1_time_c',
            'label' => 'LBL_LAWYER_1_TIME',
            'customCode' => '<input id="lawyer_1_time_c" name="lawyer_1_time_c" size="2" maxlength="2" type="text" value="{$fields.lawyer_1_time_c.value}" style = "width:25%;" readonly/><select disabled id="duration_minutes_c" name="duration_minutes_c">
              <option value="{$fields.duration_minutes_c.value}">{$fields.duration_minutes_c.value}</option></select>
            ',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'assigned_lawyer_2_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSIGNED_LAWYER_2',
          ),
          1 => 
          array (
            'name' => 'lawyer_2_time_c',
            'label' => 'LBL_LAWYER_2_TIME',
            'customCode' => '<input id="lawyer_2_time_c" name="lawyer_2_time_c" size="2" maxlength="2" type="text" value="{$fields.lawyer_2_time_c.value}" readonly = "readonly" style = "width:25%;" /><select disabled id="duration_minutes2_c" name="duration_minutes2_c">
              <option value="{$fields.duration_minutes2_c.value}">{$fields.duration_minutes2_c.value}</option></select>
            ',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'disc_case_assistant_c',
            'label' => 'LBL_DISC_CASE_ASSISTANT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'time_spent_record_creator_c',
            'label' => 'LBL_TIME_SPENT_RECORD_CREATOR',
            'customCode' => '<input id="time_spent_record_creator_c" name="time_spent_record_creator_c" size="2" maxlength="2" type="text" value="{$fields.time_spent_record_creator_c.value}" readonly style = "width:25%;"/>&nbsp;<select disabled id="record_creator_duration_c" name="record_creator_duration_c">
              <option value="{$fields.record_creator_duration_c.value}">{$fields.record_creator_duration_c.value}</option></select>
            ',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'time_spent_discovery_assist_c',
            'label' => 'LBL_TIME_SPENT_DISCOVERY_ASSIST',
            'customCode' => '<input id="time_spent_discovery_assist_c" name="time_spent_discovery_assist_c" size="2" maxlength="2" type="text" value="{$fields.time_spent_discovery_assist_c.value}" readonly = "readonly" style = "width:25%;"/>&nbsp;<select disabled id="discovery_assistant_duration_c" name="discovery_assistant_duration_c">
              <option value="{$fields.discovery_assistant_duration_c.value}">{$fields.discovery_assistant_duration_c.value}</option></select>
            ',
          ),
        ),
      ),
    ),
  ),
);
