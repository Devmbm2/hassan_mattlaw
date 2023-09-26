<?php
$layout_defs["Contacts"]["subpanel_setup"]['contact_medr_medical_records'] = array (
 // 'order' => 125,
  'module' => 'MEDR_Medical_Records',
  'subpanel_name' => 'Contact_subpanel_medr_medical_records_contacts',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACT_MEDR_MEDICAL_RECORDS',
  'get_subpanel_data' => 'contact_medr_medical_records',
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
$layout_defs["Contacts"]["subpanel_setup"]['contact_medr_medical_records']['searchdefs'] =
array ( 'name' =>
      array (
          'name' => 'name',
          'default' => true,
          'width' => '10%',
      ),
);
