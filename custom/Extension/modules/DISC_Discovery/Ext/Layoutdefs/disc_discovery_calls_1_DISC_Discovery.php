<?php
 // created: 2022-08-03 11:47:54
$layout_defs["DISC_Discovery"]["subpanel_setup"]['disc_discovery_calls_1'] = array (
  'order' => 100,
  'module' => 'Calls',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DISC_DISCOVERY_CALLS_1_FROM_CALLS_TITLE',
  'get_subpanel_data' => 'disc_discovery_calls_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreateDiscovery',
    ),
    // 1 => 
    // array (
    //   'widget_class' => 'SubPanelTopSelectButton',
    //   'mode' => 'MultiSelect',
    // ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopFilterButton',
    ), 
  ),
);
$layout_defs["DISC_Discovery"]["subpanel_setup"]['disc_discovery_calls_1']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
        );