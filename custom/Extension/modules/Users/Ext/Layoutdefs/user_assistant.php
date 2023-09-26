<?php
$layout_defs["Users"]["subpanel_setup"]['user_assistant'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_USER_ASSISTANT',
  'get_subpanel_data' => 'direct_reports',
  'top_buttons' => 
  array (
   /*  0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ), */
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);



?>