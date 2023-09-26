<?php
$layout_defs["Leads"]["subpanel_setup"]['lead_ht_address_book'] = array (
  'order' => 100,
  'module' => 'ht_address_book',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LEAD_HT_ADDRESS_BOOK',
  'get_subpanel_data' => 'lead_ht_address_book',
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



?>