<?php
$module_name = 'MREQ_MEDB_Requests';
$_object_name = 'mreq_medb_requests';
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
        'LBL_WORKFLOW_STATUS_PANEL' => 
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
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status_id',
            'studio' => 'visible',
            'label' => 'LBL_DOC_STATUS',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
          1 => 
          array (
            'name' => 'related_running_bill_client',
            'label' => 'LBL_RELATED_RUNNING_BILL_CLIENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mreq_medb_requests_medb_medical_bills_name',
          ),
          1 => 
          array (
            'name' => 'mdoc_medb_doc_mreq_medb_requests_name',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_range_bills_liens_c',
            'studio' => 'visible',
            'label' => 'LBL_DATE_RANGE_BILLS_LIENS',
          ),
          1 => 
          array (
            'name' => 'date_requested',
            'label' => 'LBL_DATE_REQUESTED',
          ),
        ),
        5 => 
        array (
          0 => 'description',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
      ),
      'lbl_workflow_status_panel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'workflow_end_status_c',
            'label' => 'LBL_WORKFLOW_END_STATUS',
          ),
          1 => 
          array (
            'name' => 'workflow_not_done_c',
            'studio' => 'visible',
            'label' => 'LBL_WORKFLOW_NOT_DONE_REASON',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'workflow_end_reason_c',
            'label' => 'LBL_WORKFLOW_END_REASON',
          ),
          1 => 
          array (
            'name' => 'workflow_opt_out_reason_c',
            'label' => 'LBL_WORKFLOW_OPT_OUT_REASON',
          ),
        ),
      ),
    ),
  ),
);
