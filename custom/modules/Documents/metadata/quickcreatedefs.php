<?php
$viewdefs ['Documents'] = 
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
          0 => '<input type="hidden" name="old_id" value="{$fields.document_revision_id.value}">',
          1 => '<input type="hidden" name="parent_id" value="{$smarty.request.parent_id}">',
          2 => '<input type="hidden" name="parent_type" value="{$smarty.request.parent_type}">',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'include/javascript/popup_parent_helper.js',
        ),
        1 => 
        array (
          'file' => 'cache/include/javascript/sugar_grp_jsolait.js',
        ),
        2 => 
        array (
          'file' => 'modules/Documents/documents.js',
        ),
        3 => 
        array (
          'file' => 'custom/include/javascript/visible/doc_type.js',
        ),
        4 => 
        array (
          'file' => 'custom/include/javascript/visible/doc_transcript.js',
        ),
        5 => 
        array (
          'file' => 'custom/include/javascript/visible/doc_insurance.js',
        ),
        6 => 
        array (
          'file' => 'custom/modules/Documents/js/custom_script.js',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_DOCUMENT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
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
    ),
    'panels' => 
    array (
      'lbl_document_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'authors_name_c',
            'label' => 'LBL_AUTHORS_NAME',
          ),
          1 => 
          array (
            'name' => 'contacts_documents_1_name',
            'label' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE',
          ),
        ),
        1 => 
        array (
          0 => 'category_id',
          1 => 
          array (
            'name' => 'date_of_document_c',
            'label' => 'LBL_DATE_OF_DOCUMENT',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'subcategory_id',
            'label' => 'LBL_SF_SUBCATEGORY',
          ),
          1 => 'document_name',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'trial_type',
            'label' => 'LBL_TRIAL_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'def_insurance_types_c',
            'studio' => 'visible',
            'label' => 'LBL_DEF_INSURANCE_TYPES',
          ),
          1 => 
          array (
            'name' => 'format_c',
            'studio' => 'visible',
            'label' => 'LBL_FORMAT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'hard_or_soft_doc',
            'studio' => true,
            'label' => 'LBL_HARD_OR_SOFT_DOC',
          ),
          1 => 
          array (
            'name' => 'soft_documents_c',
            'label' => 'LBL_SOFT_DOCUMENTS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'filename',
            'displayParams' => 
            array (
              'required' => true,
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
          1 => 
          array (
            'name' => 'transcript_types_c',
            'studio' => 'visible',
            'label' => 'LBL_TRANSCRIPT_TYPES',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'insurance_company',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
          1 => 
          array (
            'name' => 'insurance_type_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_TYPE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'adjuster',
            'label' => 'LBL_ADJUSTER',
          ),
          1 => 
          array (
            'name' => 'claim_number',
            'label' => 'LBL_CLAIM_NUMBER',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'trial_transcript_types_c',
            'studio' => 'visible',
            'label' => 'LBL_TRIAL_TRANSCRIPT_TYPES',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'authorization_types_c',
            'studio' => 'visible',
            'label' => 'LBL_AUTHORIZATION_TYPES',
          ),
          1 => 
          array (
            'name' => 'number_of_vehicles_stacking_c',
            'label' => 'LBL_NUMBER_OF_VEHICLES_STACKING',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'displayParams' => 
            array (
              'rows' => 10,
              'cols' => 120,
            ),
          ),
          1 => 
          array (
            'name' => 'investigation_types_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTIGATION_TYPES',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'doc_type',
            'comment' => 'Document type (ex: Google, box.net, IBM SmartCloud)',
            'studio' => 
            array (
              'wirelesseditview' => false,
              'wirelessdetailview' => false,
              'wirelesslistview' => false,
              'wireless_basic_search' => false,
            ),
            'label' => 'LBL_DOC_TYPE',
          ),
          1 => 
          array (
            'name' => 'outgoing_document',
            'studio' => 'false',
            'label' => 'LBL_OUTGOING_DOCUMENT',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'case_type_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_TYPE',
          ),
          1 => 
          array (
            'name' => 'case_status_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_STATUS',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'attachments',
            'comment' => '',
            'label' => 'LBL_MULTIPLE_ATTACHMENTS',
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
        ),
      ),
    ),
  ),
);
