<?php
 // created: 2018-08-17 16:07:17
$layout_defs["MEDB_Medical_Bills"]["subpanel_setup"]['medb_medical_bills_documents_reductions'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'sort_by' => 'date_of_document_c',
  'title_key' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_REDUCTIONS_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'medb_medical_bills_documents_reductions',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);

$layout_defs["MEDB_Medical_Bills"]["subpanel_setup"]['medb_medical_bills_documents_1'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'sort_by' => 'date_of_document_c',
  'title_key' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'medb_medical_bills_documents_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
