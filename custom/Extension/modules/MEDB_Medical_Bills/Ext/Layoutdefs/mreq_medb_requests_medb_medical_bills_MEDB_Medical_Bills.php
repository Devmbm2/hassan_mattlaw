<?php
 // created: 2018-08-17 15:14:58
$layout_defs["MEDB_Medical_Bills"]["subpanel_setup"]['mreq_medb_requests_medb_medical_bills'] = array (
  'order' => 100,
  'module' => 'MREQ_MEDB_Requests',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'sort_by' => 'date_requested',
  'title_key' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MREQ_MEDB_REQUESTS_TITLE',
  'get_subpanel_data' => 'mreq_medb_requests_medb_medical_bills',
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
