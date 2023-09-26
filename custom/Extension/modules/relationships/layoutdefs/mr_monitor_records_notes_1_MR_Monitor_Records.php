<?php
 // created: 2020-04-15 02:24:12
$layout_defs["MR_Monitor_Records"]["subpanel_setup"]['mr_monitor_records_notes_1'] = array (
  'order' => 100,
  'module' => 'Notes',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MR_MONITOR_RECORDS_NOTES_1_FROM_NOTES_TITLE',
  'get_subpanel_data' => 'mr_monitor_records_notes_1',
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
