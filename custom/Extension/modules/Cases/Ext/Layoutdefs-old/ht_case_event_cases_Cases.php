<?php
 // created: 2017-12-15 04:39:29
$layout_defs["Cases"]["subpanel_setup"]['ht_case_event_cases'] = array (
  //'order' => 11,
  'module' => 'ht_case_event',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_HT_CASE_EVENT_CASES_FROM_HT_CASE_EVENT_TITLE',
  'get_subpanel_data' => 'ht_case_event_cases',
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
$layout_defs["Cases"]["subpanel_setup"]['ht_case_event_cases']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),

);
