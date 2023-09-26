<?php
 // created: 2018-01-07 21:19:20
$layout_defs["Contacts"]["subpanel_setup"]['contacts_medp_medical_providers_1'] = array (
  'order' => 100,
  'module' => 'MEDP_Medical_Providers',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_MEDP_MEDICAL_PROVIDERS_1_FROM_MEDP_MEDICAL_PROVIDERS_TITLE',
  'get_subpanel_data' => 'contacts_medp_medical_providers_1',
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
