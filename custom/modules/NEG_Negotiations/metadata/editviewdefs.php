<?php
$module_name = 'NEG_Negotiations';
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
		'LBL_EDITVIEW_EVENT' => 
        array (
          'newTab' => false,
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
          0 => 
          array (
            'name' => 'initial_counter',
            'studio' => 'visible',
            'label' => 'LBL_INITIAL_COUNTER',
          ),
          1 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
          1 => 
          array (
            'name' => 'sent_rec',
            'studio' => 'visible',
            'label' => 'LBL_SENT_REC',
          ),
        ),
        2 => 
        array (
          0 => 'document_name',
          1 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'date_of_negotiation_c',
            'label' => 'LBL_DATE_OF_NEGOTIATION',
          ),
          1 => 
          array (
            'name' => 'exp_date',
            'label' => 'LBL_DOC_EXP_DATE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'neg_negotiations_cases_name',
          ),
          1 => 
          array (
            'name' => 'done',
            'label' => 'LBL_DONE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'adjuster_lawyer',
            'studio' => 'visible',
            'label' => 'LBL_ADJUSTER_LAWYER',
          ),
          1 => 
          array (
            'name' => 'mode',
            'studio' => 'visible',
            'label' => 'LBL_MODE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'response',
            'studio' => 'visible',
            'label' => 'LBL_RESPONSE',
          ),
        ),
        7 => 
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
        8 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'case_assigned_to_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_ASSIGNED_TO',
          ),
        ),
		11 => 
        array (
          0 => 
          array (
            'name' => 'multiple_assigned_users',
            'studio' => 'visible',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
		  1 => '',
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
          0 => 'type_c',
          1 => 'event_type',
        ),
        2 => 
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
