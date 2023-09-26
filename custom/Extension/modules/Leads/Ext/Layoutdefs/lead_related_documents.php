<?php
$layout_defs['Leads']['subpanel_setup']['soft_documents'] = array (
  'order' => 105,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'soft_documents',
  'title_key' => 'LBL_SOFT_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'documents',  
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateSoftLeadButton',
    ),
  ),
);

$layout_defs['Leads']['subpanel_setup']['hard_documents'] = array (
  'order' => 105,
  'sort_by' => 'date_of_document_c',
  'sort_order' => 'DESC',
  'module' => 'Documents',
  'subpanel_name' => 'hard_documents',
  'title_key' => 'LBL_HARD_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'documents',  
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateHardButton',
    ),
  ),
);

