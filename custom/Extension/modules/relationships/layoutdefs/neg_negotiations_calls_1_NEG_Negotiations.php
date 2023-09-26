<?php
 // created: 2022-08-03 13:18:36
$layout_defs["NEG_Negotiations"]["subpanel_setup"]['neg_negotiations_calls_1'] = array (
  'order' => 100,
  'module' => 'Calls',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_NEG_NEGOTIATIONS_CALLS_1_FROM_CALLS_TITLE',
  'get_subpanel_data' => 'neg_negotiations_calls_1',
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
