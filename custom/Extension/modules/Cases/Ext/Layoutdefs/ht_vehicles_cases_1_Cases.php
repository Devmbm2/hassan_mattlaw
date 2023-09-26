<?php
 // created: 2020-11-10 07:25:26
$layout_defs["Cases"]["subpanel_setup"]['ht_vehicles_cases_1'] = array (
  'order' => 100,
  'module' => 'ht_vehicles',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_HT_VEHICLES_CASES_1_FROM_HT_VEHICLES_TITLE',
  'get_subpanel_data' => 'ht_vehicles_cases_1',
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
    2 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['ht_vehicles_cases_1']['searchdefs'] =
array ( 'name' =>
    array (
      'name' => 'name',
      'default' => true,
      'width' => '10%',
    ),
);