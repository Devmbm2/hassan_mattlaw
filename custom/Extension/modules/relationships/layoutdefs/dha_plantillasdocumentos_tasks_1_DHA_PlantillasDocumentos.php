<?php
 // created: 2017-10-26 12:38:34
$layout_defs["DHA_PlantillasDocumentos"]["subpanel_setup"]['dha_plantillasdocumentos_tasks_1'] = array (
  'order' => 100,
  'module' => 'Tasks',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DHA_PLANTILLASDOCUMENTOS_TASKS_1_FROM_TASKS_TITLE',
  'get_subpanel_data' => 'dha_plantillasdocumentos_tasks_1',
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
