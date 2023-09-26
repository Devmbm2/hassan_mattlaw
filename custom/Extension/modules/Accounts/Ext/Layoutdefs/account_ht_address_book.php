<?php
$layout_defs["Accounts"]["subpanel_setup"]['account_ht_address_book'] = array (
  'order' => 2,
  'module' => 'ht_address_book',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_ACCOUNT_HT_ADDRESS_BOOK',
  'get_subpanel_data' => 'account_ht_address_book',
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