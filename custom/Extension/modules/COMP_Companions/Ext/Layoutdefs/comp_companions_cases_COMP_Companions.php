<?php
 // created: 2019-06-06 08:56:52
$layout_defs["COMP_Companions"]["subpanel_setup"]['comp_companions_cases'] = array (
  'order' => 100,
  'module' => 'Cases',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
  'get_subpanel_data' => 'comp_companions_cases',
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
