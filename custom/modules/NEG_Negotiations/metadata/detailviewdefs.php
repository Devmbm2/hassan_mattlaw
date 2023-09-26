<?php
$module_name = 'NEG_Negotiations';
$_object_name = 'neg_negotiations';
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
            'customCode' => '<input type="button" onclick="mark_done(\'{$fields.id.value}\', \'NEG_Negotiations\' );" value="Mark Done" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="mark_done_notify(\'{$fields.id.value}\', \'NEG_Negotiations\' );" value="Mark Done & Notify" />',
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
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
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
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_DEFENDANT',
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
            'label' => 'LBL_FILE_UPLOAD',
          ),
        ),
        8 => 
        array (
          0 => 'description',
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
    ),
  ),
);
