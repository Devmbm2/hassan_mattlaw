<?php
 // created: 2018-08-17 15:40:04
$layout_defs["MEDB_Medical_Bills"]["subpanel_setup"]['medb_medical_bills_mdoc_incoming_bills_1'] = array (
  'order' => 100,
  'module' => 'MDOC_Incoming_Bills',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MDOC_INCOMING_BILLS_TITLE',
  'get_subpanel_data' => 'medb_medical_bills_mdoc_incoming_bills_1',
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
