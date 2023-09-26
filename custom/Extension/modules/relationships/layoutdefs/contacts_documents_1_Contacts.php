<?php
 // created: 2019-09-16 10:18:47
$layout_defs["Contacts"]["subpanel_setup"]['contacts_documents_1'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'Transcripts_Statements',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'contacts_documents_1',
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
