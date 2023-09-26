<?php
 // created: 2017-06-16 20:36:27
$layout_defs["Cases"]["subpanel_setup"]['cases_fp_events_1'] = array (
  //'order' => 11,
  'sort_by' => 'date_start',
  'sort_order' => 'desc',
  'module' => 'FP_events',
  'subpanel_name' => 'default',
  'title_key' => 'LBL_CASES_FP_EVENTS_1_FROM_FP_EVENTS_TITLE',
  'get_subpanel_data' => 'cases_fp_events_1',
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
    //1 =>
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
);

$layout_defs["Cases"]["subpanel_setup"]['cases_fp_events_1']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),

);
