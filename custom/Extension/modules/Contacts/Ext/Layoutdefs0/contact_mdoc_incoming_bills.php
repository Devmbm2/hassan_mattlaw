<?php
$layout_defs["Contacts"]["subpanel_setup"]['contact_mdoc_incoming_bills'] = array (
  'order' => 130,
  'module' => 'MDOC_Incoming_Bills',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACT_MDOC_INCOMING_BILLS',
  'get_subpanel_data' => 'contact_mdoc_incoming_bills',
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
