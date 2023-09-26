<?php
 // created: 2019-09-28 00:22:37
$layout_defs["Contacts"]["subpanel_setup"]['contacts_neg_negotiations_1'] = array (
  'order' => 100,
  'module' => 'NEG_Negotiations',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_NEG_NEGOTIATIONS_1_FROM_NEG_NEGOTIATIONS_TITLE',
  'get_subpanel_data' => 'contacts_neg_negotiations_1',
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
