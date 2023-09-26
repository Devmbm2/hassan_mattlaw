<?php
 // created: 2017-06-13 13:49:07
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases'] = array (
  'order' => 9,
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_FROM_DISC_DISCOVERY_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
//   'get_subpanel_data' => 'function:get_discovery_processed_done',
//   'function_parameters' => 
//   array (
//     'import_function_file' => 'custom/modules/DISC_Discovery/get_discovery_done.php',
// ),
  'generate_select' => true,
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
    //1 => 
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
  'where'=> " AND disc_discovery.done = 1",
);
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_3rd'] = array (
  'order' => 10,
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases_3rd',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_3RD_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonDiscovery_3rdTypeButton',
    ),
    1 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
    //1 => 
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_3rd']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);

$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_done'] = array (
  'order' => 47,
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases_done',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_DONE_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
  'top_buttons' => 
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_done']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);