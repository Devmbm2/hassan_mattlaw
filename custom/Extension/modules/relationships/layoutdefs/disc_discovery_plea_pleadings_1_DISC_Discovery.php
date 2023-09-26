<?php
 // created: 2018-06-30 17:22:47
$layout_defs["DISC_Discovery"]["subpanel_setup"]['disc_discovery_plea_pleadings_1'] = array (
  'order' => 100,
  'module' => 'PLEA_Pleadings',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DISC_DISCOVERY_PLEA_PLEADINGS_1_FROM_PLEA_PLEADINGS_TITLE',
  'get_subpanel_data' => 'disc_discovery_plea_pleadings_1',
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
