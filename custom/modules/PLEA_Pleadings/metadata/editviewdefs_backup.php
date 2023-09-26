<?php
$module_name = 'PLEA_Pleadings';
$viewdefs [$module_name] = 
array (
  'EditView' => 
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
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/plead_category.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/plead_hearingtype.js',
        ),
        2 => 
        array (
          'file' => 'custom/include/javascript/visible/plead_noticetype.js',
        ),
        3 => 
        array (
          'file' => 'custom/include/javascript/visible/plead_subcat.js',
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
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'incoming_or_outgoing',
            'studio' => 'visible',
            'label' => 'LBL_INCOMING_OR_OUTGOING',
          ),
          1 => 
          array (
            'name' => 'date_filed_c',
            'label' => 'LBL_DATE_FILED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'plea_pleadings_cases_name',
          ),
          1 => 
          array (
            'name' => 'done_c',
            'label' => 'LBL_DONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'done_holder_c',
            'label' => 'LBL_DONE_HOLDER',
          ),
          1 => 
          array (
            'name' => 'time_spent_c',
            'label' => 'LBL_TIME_SPENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'pleading_name_c',
            'label' => 'LBL_PLEADING_NAME',
          ),
          1 => 'category_id',
        ),
        4 => 
        array (
          0 => 'subcategory_id',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'complaint_answer_type',
            'studio' => 'visible',
            'label' => 'LBL_COMPLAINT_ANSWER_TYPE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'name_of_motion',
            'label' => 'LBL_NAME_OF_MOTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'notice_type',
            'studio' => 'visible',
            'label' => 'LBL_NOTICE_TYPE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'filing_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_FILING_SUB_TYPE',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'hearing_type',
            'studio' => 'visible',
            'label' => 'LBL_HEARING_TYPE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'orders_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_ORDERS_SUB_TYPE',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'human_defendant',
            'studio' => 'visible',
            'label' => 'LBL_HUMAN_DEFENDANT',
          ),
          1 => 
          array (
            'name' => 'defendant_organization',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT_ORGANIZATION',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'author_c',
            'label' => 'LBL_AUTHOR',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
        15 => 
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
        16 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
      ),
    ),
  ),
);
