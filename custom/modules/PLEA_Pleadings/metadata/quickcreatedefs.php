<?php
$module_name = 'PLEA_Pleadings';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_EVENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'document_name',
          1 => 
          array (
            'name' => 'author_type',
            'label' => 'LBL_AUTHOR_TYPE',
          ),
        ),
        1 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'author_c',
            'label' => 'LBL_AUTHOR',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'incoming_or_outgoing',
            'studio' => 'visible',
            'label' => 'LBL_INCOMING_OR_OUTGOING',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'plea_pleadings_cases_name',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'outgoing_document',
            'label' => 'LBL_OUTGOING_DOCUMENT',
          ),
          1 => 
          array (
            'name' => 'document_processed_description',
            'label' => 'LBL_DOCUMENT_PROCESSED_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 'category_id',
          1 => '',
        ),
        6 => 
        array (
          0 => 'subcategory_id',
          1 => '',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'complaint_answer_type',
            'studio' => 'visible',
            'label' => 'LBL_COMPLAINT_ANSWER_TYPE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'name_of_motion',
            'label' => 'LBL_NAME_OF_MOTION',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'notice_type',
            'studio' => 'visible',
            'label' => 'LBL_NOTICE_TYPE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'filing_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_FILING_SUB_TYPE',
          ),
          1 => 
          array (
            'name' => 'filing_description',
            'studio' => 'visible',
            'label' => 'LBL_FILING_DESCRIPTION',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'hearing_type',
            'studio' => 'visible',
            'label' => 'LBL_HEARING_TYPE',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'orders_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_ORDERS_SUB_TYPE',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'witness_list_type_c',
            'studio' => 'visible',
            'label' => 'LBL_WITNESS_LIST_TYPE',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'exhibit_type_c',
            'studio' => 'visible',
            'label' => 'LBL_EXHIBIT_TYPE',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'stipulation_type_c',
            'studio' => 'visible',
            'label' => 'LBL_STIPULATION_TYPE',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'sum_subp_type_c',
            'studio' => 'visible',
            'label' => 'LBL_SUM_SUBP_TYPE',
          ),
        ),
        19 => 
        array (
          0 => 'pleading_sub_type_description',
        ),
        20 => 
        array (
          0 => 
          array (
            'name' => 'date_filed_c',
            'label' => 'LBL_DATE_FILED',
          ),
        ),
        21 => 
        array (
          0 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
        ),
        22 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
        23 => 
        array (
          0 => 
          array (
            'name' => 'time_spent_c',
            'label' => 'LBL_TIME_SPENT',
          ),
        ),
        24 => 
        array (
          0 => 
          array (
            'name' => 'lastname_c',
            'label' => 'LBL_LASTNAME',
          ),
          1 => 
          array (
            'name' => 'nickname_c',
            'label' => 'LBL_NICKNAME',
          ),
        ),
      ),
      'lbl_editview_event' => 
      array (
        0 => 
        array (
          0 => 'date_start',
          1 => 'date_end',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'duration',
            'customCode' => '
                @@FIELD@@
				<input id="event_event_id" name="event_event_id" type="hidden" value="">
				<input id="deleted_events" name="deleted_events" type="hidden" value="">
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
          1 => 
          array (
            'name' => 'events_multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
        ),
      ),
    ),
  ),
);
