<?php
 // created: 2017-06-06 17:12:58
$layout_defs["DEF_Client_Insurance"]["subpanel_setup"]['def_client_insurance_cases'] = array (
  'order' => 100,
  'module' => 'Cases',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DEF_CLIENT_INSURANCE_CASES_FROM_CASES_TITLE',
  'get_subpanel_data' => 'def_client_insurance_cases',
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
