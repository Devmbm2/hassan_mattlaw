<?php
 // created: 2017-09-12 13:27:33
$layout_defs["Cases"]["subpanel_setup"]['soft_documents'] = array (
  'order' => 18,
  'sort_by' => 'date_entered',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'soft_documents',
  'title_key' => 'LBL_SOFT_DOCUMENTS',
  'get_subpanel_data' => 'documents',
  // 'generate_select' => true,
   // 'function_parameters' => array(
   //     File where the above function is defined at
        // 'import_function_file' => 'custom/include/custom_utils.php',
        // ),

  'top_buttons' =>
  array (
	 0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateSoftButtonTemplate',
    ),
	1 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateSoftButton',
    ),
  2 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),

  ),
);
$layout_defs["Cases"]["subpanel_setup"]['soft_documents']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['hard_documents'] = array (
  'order' => 12,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'hard_documents',
  'title_key' => 'LBL_HARD_DOCUMENTS',
  'get_subpanel_data' => 'function:getHardDocuments',
  'function_parameters' =>
    array (
        'import_function_file' => 'custom/include/custom_utils.php',
    ),
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQCHardTypeButton',
    ),
    1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['hard_documents']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['trail_documents'] = array (
  'order' => 23,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'trail_documents',
  'title_key' => 'LBL_TRAIL_DOCUMENTS',
  'get_subpanel_data' => 'documents',
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQCTrailTypeButton',
    ),
    1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['trail_documents']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['authorizations'] = array (
	'order' => 1,
	'sort_by' => 'date_of_document_c',
	'sort_order' => 'DESC',
	'module' => 'Documents',
	'subpanel_name' => 'Authorizations',
	'title_key' => 'LBL_AUTHORIZATIONS',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
	0 =>
	array (
	  'widget_class' => 'SubPanelTopButtonQCAuthorizationsTypeButton',
	),
	1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['authorizations']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['correspondence'] = array (
	'order' => 6,
	'sort_by' => 'date_of_document_c',
	'sort_order' => 'DESC',
	'module' => 'Documents',
	'subpanel_name' => 'Correspondence',
	'title_key' => 'LBL_CORRESPONDENCE',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
	0 =>
	array (
	  'widget_class' => 'SubPanelTopButtonQCCorrespondenceTypeButton',
	),
	1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['correspondence']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['investigation'] = array (
	'order' => 13,
	'sort_by' => 'date_of_document_c',
	'sort_order' => 'DESC',
	'module' => 'Documents',
	'subpanel_name' => 'Investigation',
	'title_key' => 'LBL_INVESTIGATION',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
		/* 0 =>
		array (
		  'widget_class' => 'SubPanelTopButtonQCHardTypeButton',
		), */
		0 =>
		array (
		  'widget_class' => 'SubPanelTopCreateButton',
		),
		1 =>array (
			'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
	  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['investigation']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['client_insurance'] = array (
	'order' => 3,
	'sort_by' => 'document_name',
	'sort_order' => 'ASC',
	'module' => 'Documents',
	'subpanel_name' => 'Client_Insurance',
	'title_key' => 'LBL_CLIENT_INSURANCE',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
	0 =>
	array (
	  'widget_class' => 'SubPanelTopButtonQCClient_InsuranceTypeButton',
	),
	1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['client_insurance']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['transcripts_statements'] = array (
	'order' => 22,
	'sort_by' => 'date_of_document_c',
	'sort_order' => 'DESC',
	'module' => 'Documents',
	'subpanel_name' => 'Transcripts_Statements',
	'title_key' => 'LBL_TRANSCRIPTS_STATEMENTS',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
		/* 0 =>
		array (
		  'widget_class' => 'SubPanelTopButtonQCHardTypeButton',
		), */
		0 =>
		array (
		  'widget_class' => 'SubPanelTopCreateButton',
		),
		1 =>array (
			'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
	  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['transcripts_statements']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['defendant_insurance'] = array (
	'order' => 7,
	'sort_by' => 'document_name',
	'sort_order' => 'ASC',
	'module' => 'Documents',
	'subpanel_name' => 'Defendant_Insurance',
	'title_key' => 'LBL_DEFENDANT_INSURANCE',
	'get_subpanel_data' => 'documents',
	'top_buttons' =>
	array (
	0 =>
	array (
	  'widget_class' => 'SubPanelTopButtonQCdefendant_insuranceTypeButton',
	),
	1 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  ),
	),
);
$layout_defs["Cases"]["subpanel_setup"]['defendant_insurance']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
