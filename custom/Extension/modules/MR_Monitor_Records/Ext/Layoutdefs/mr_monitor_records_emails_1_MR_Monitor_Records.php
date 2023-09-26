<?php
 // created: 2020-04-15 02:28:50
$layout_defs["MR_Monitor_Records"]["subpanel_setup"]['mr_monitor_records_emails_1'] = array (
  'order' => 100,
  'module' => 'Emails',
  'subpanel_name' => 'ForQueues',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MR_MONITOR_RECORDS_EMAILS_1_FROM_EMAILS_TITLE',
  'get_subpanel_data' => 'mr_monitor_records_emails_1',
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
