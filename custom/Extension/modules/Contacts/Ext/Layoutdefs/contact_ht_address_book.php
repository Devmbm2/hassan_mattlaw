<?php
$layout_defs["Contacts"]["subpanel_setup"]['contact_ht_address_book'] = array (
//  'order' => 130,
  'module' => 'ht_address_book',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACT_HT_ADDRESS_BOOK',
  'get_subpanel_data' => 'contact_ht_address_book',
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
    2 =>array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',

),
),
);
$layout_defs["Contacts"]["subpanel_setup"]['contact_ht_address_book']['searchdefs'] =
array ( 'name' =>
      array (
          'name' => 'name',
          'default' => true,
          'width' => '10%',
      ),
);
