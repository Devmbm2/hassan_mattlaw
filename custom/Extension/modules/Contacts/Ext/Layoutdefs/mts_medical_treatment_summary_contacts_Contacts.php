<?php
 // created: 2018-01-20 19:59:20
$layout_defs["Contacts"]["subpanel_setup"]['mts_medical_treatment_summary_contacts'] = array (
  //'order' => 123,
  'sort_by' => 'treatment_date',
  'sort_order' => 'desc',
  'module' => 'MTS_Medical_Treatment_Summary',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'sort_by' => 'date_modified',
  'title_key' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_MTS_MEDICAL_TREATMENT_SUMMARY_TITLE',
  'get_subpanel_data' => 'mts_medical_treatment_summary_contacts',
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

$layout_defs["Contacts"]["subpanel_setup"]['mts_medical_treatment_summary_contacts']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);