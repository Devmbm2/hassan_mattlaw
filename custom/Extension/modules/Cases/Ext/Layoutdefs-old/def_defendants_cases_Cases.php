<?php
 // created: 2017-07-11 18:42:20
$layout_defs["Cases"]["subpanel_setup"]['def_defendants_cases'] = array (
  //'order' => 8,
  'module' => 'DEF_Defendants',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'name',
  'title_key' => 'LBL_DEF_DEFENDANTS_CASES_FROM_DEF_DEFENDANTS_TITLE',
  'get_subpanel_data' => 'def_defendants_cases',
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    //1 =>
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
    1 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);


$layout_defs["Cases"]["subpanel_setup"]['def_defendants_cases']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);
