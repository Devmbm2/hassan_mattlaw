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
          'file' => 'custom/include/javascript/visible/neg_type.js',
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
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
        ),
        1 => 
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
	    'displayParam' =>
            array (
              'javascript' => 'load = initNegType();',
            ),
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'sent_rec',
            'studio' => 'visible',
            'label' => 'LBL_SENT_REC',
          ),
          1 => 
          array (
            'name' => 'insurance_company',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_COMPANY',
          ),
        ),
        3 => 
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
        4 => 
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
        5 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
          1 => 
          array (
            'name' => 'neg_negotiations_cases_name',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'defendant',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT',
          ),
          1 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
          1 => 
          array (
            'name' => 'exp_date',
            'label' => 'LBL_DOC_EXP_DATE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'comment' => 'Date record last modified',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
      ),
    ),
  ),
);
?>
