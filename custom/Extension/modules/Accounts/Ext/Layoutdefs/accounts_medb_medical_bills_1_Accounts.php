<?php
 // created: 2019-09-24 10:25:35
$layout_defs["Accounts"]["subpanel_setup"]['medical_provider_account'] = array (
  'order' => 100,
  'module' => 'MEDB_Medical_Bills',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'get_subpanel_data' => 'medical_provider_account',
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
