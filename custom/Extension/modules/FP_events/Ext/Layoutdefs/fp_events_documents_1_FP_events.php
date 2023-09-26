<?php
 // created: 2022-05-27 17:21:01
$layout_defs["FP_events"]["subpanel_setup"]['fp_events_documents_1'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'Authorizations',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_FP_EVENTS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'fp_events_documents_1',
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
