<?php
$module_name = 'PLEA_Pleadings';
$_object_name = 'plea_pleadings';
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
            'customCode' => '<input type="button" onclick="mark_done(\'{$fields.id.value}\', \'PLEA_Pleadings\' );" value="Mark Done" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="mark_done_notify(\'{$fields.id.value}\', \'PLEA_Pleadings\' );" value="Mark Done & Notify" />',
          ),
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
        'DEFAULT' => 
        array (
          'newTab' => true,
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
        ),
        6 => 
        array (
          0 => 'subcategory_id',
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
          0 => 'uploadfile',
        ),
        22 => 
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
        23 => 
        array (
          0 => 'description',
        ),
        24 => 
        array (
          0 => 
          array (
            'name' => 'time_spent_c',
            'label' => 'LBL_TIME_SPENT',
          ),
          1 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
      ),
    ),
  ),
);
