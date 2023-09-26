<?php
 // created: 2018-10-02 16:16:19
$layout_defs["MREQ_MEDB_Requests"]["subpanel_setup"]['mreq_medb_requests_tasks_1'] = array (
  'order' => 100,
  'module' => 'Tasks',
  //'subpanel_name' => 'custom_activities',
  'subpanel_name' => 'tasks',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MREQ_MEDB_REQUESTS_TASKS_1_FROM_TASKS_TITLE',
  'get_subpanel_data' => 'mreq_medb_requests_tasks_1',
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
