<?php
$viewdefs ['Documents'] = 
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
            'customCode' => '<input type="button" onclick="mark_done(\'{$fields.id.value}\', \'Documents\' );" value="Mark Done" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="mark_done_notify(\'{$fields.id.value}\', \'Documents\' );" value="Mark Done & Notify" />',
          ),
        ),
        'hidden' => 
        array (
          0 => '<input type="hidden" name="old_id" value="{$fields.document_revision_id.value}">',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Documents/js/detail.js',
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
      ),
      'syncDetailEditViews' => true,
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
          0 => 'subcategory_id',
          1 => 
          array (
            'name' => 'document_name',
            'label' => 'LBL_DOC_NAME',
          ),
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
            'name' => 'cases_documents_name',
            'label' => 'LBL_CASES',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'hard_or_soft_doc',
            'studio' => true,
            'label' => 'LBL_HARD_OR_SOFT_DOC',
          ),
          1 => 
          array (
            'name' => 'investigation_types_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTIGATION_TYPES',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'filename',
            'displayParams' => 
            array (
              'link' => 'filename',
              'id' => 'document_revision_id',
            ),
          ),
          1 => 
          array (
            'name' => 'transcript_types_c',
            'studio' => 'visible',
            'label' => 'LBL_TRANSCRIPT_TYPES',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'insurance_type_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_TYPE',
          ),
          1 => 
          array (
            'name' => 'trial_transcript_types_c',
            'studio' => 'visible',
            'label' => 'LBL_TRIAL_TRANSCRIPT_TYPES',
          ),
        ),
        9 => 
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
        10 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        11 => 
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
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'hd_reviewed_date',
            'label' => 'LBL_HD_REVIEWED_DATE',
          ),
          1 => 
          array (
            'name' => 'hd_reviewed_by_name',
            'studio' => 'visible',
            'label' => 'LBL_HD_REVIEWED_BY',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
          1 => 
          array (
            'name' => 'modified_by_name',
            'label' => 'LBL_MODIFIED_NAME',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'fp_events_documents_1_name',
          ),
          1 => 
          array (
            'name' => 'plea_pleadings_documents_1_name',
          ),
        ),
      ),
    ),
  ),
);
