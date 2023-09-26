<?php
$layout_defs["MEDB_Medical_Bills"]["subpanel_setup"]['soft_documents'] = array (
  'order' => 100,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'soft_documents',
  'title_key' => 'LBL_SOFT_DOCUMENTS',
  'get_subpanel_data' => 'medb_medical_bills_documents_1',  
  'top_buttons' => 
  array (
	 0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateSoftButton',
    ),
   
  ),
);