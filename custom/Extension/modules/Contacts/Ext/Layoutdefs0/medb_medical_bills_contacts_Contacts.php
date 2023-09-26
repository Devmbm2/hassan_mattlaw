<?php
 // created: 2017-06-15 17:44:33
$layout_defs["Contacts"]["subpanel_setup"]['medb_medical_bills_contacts'] = array (
  'order' => 131,
  'module' => 'MEDB_Medical_Bills',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'sort_by' => 'date_modified',
  'title_key' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'get_subpanel_data' => 'medb_medical_bills_contacts',
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
