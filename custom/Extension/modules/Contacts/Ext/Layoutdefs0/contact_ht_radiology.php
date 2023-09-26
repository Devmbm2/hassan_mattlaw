<?php
$layout_defs["Contacts"]["subpanel_setup"]['contact_ht_radiology'] = array (
  'order' => 129,
  'module' => 'ht_radiology',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACT_HT_RADIOLOGY',
  'get_subpanel_data' => 'contact_ht_radiology',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);



?>