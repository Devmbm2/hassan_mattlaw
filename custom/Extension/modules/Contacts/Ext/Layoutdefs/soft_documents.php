<?php
$layout_defs["Contacts"]["subpanel_setup"]['soft_documents'] = array (
//  'order' => 133,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'soft_documents',
  'title_key' => 'LBL_SOFT_DOCUMENTS',
  'get_subpanel_data' => 'documents',  
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

$layout_defs["Contacts"]["subpanel_setup"]['soft_documents']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
