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
          1 => 'uploadfile',
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
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
        ),
        2 => 
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
        3 => 
        array (
          0 => 
          array (
            'name' => 'to_from',
            'studio' => 'visible',
            'label' => 'LBL_TO_FROM',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'response_date',
            'label' => 'LBL_RESPONSE_DATE',
          ),
          1 => 
          array (
            'name' => 'status_id',
            'studio' => 'visible',
            'label' => 'LBL_DOC_STATUS',
          ),
        ),
        5 => 
        array (
          0 => 'exp_date',
          1 => 
          array (
            'name' => 'next_step',
            'studio' => 'visible',
            'label' => 'LBL_NEXT_STEP',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'done',
            'label' => 'LBL_DONE',
          ),
          1 => 'assigned_user_name',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'companion',
            'studio' => 'visible',
            'label' => 'LBL_COMPANION',
          ),
          1 => 
          array (
            'name' => 'date_of_incident',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
        ),
        8 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'disc_discovery_cases_name',
          ),
        ),
      ),
    ),
  ),
);
?>
