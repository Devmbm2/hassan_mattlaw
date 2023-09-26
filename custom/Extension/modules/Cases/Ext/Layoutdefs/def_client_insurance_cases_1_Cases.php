<?php
 // created: 2017-06-06 17:12:58
$layout_defs["Cases"]["subpanel_setup"]['def_client_insurance_cases_1'] = array (
  'order' => 24,
  'module' => 'DEF_Client_Insurance',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'name',
  'title_key' => 'LBL_DEF_CLIENT_INSURANCE_CASES_1_FROM_DEF_CLIENT_INSURANCE_TITLE',
  'get_subpanel_data' => 'def_client_insurance_cases_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
	   /* 'widget_class' => 'SubPanelTopCreateButton', */
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
$layout_defs["Cases"]["subpanel_setup"]['def_client_insurance_cases_1']['searchdefs'] =
array ( 'name' =>
    array (
      'name' => 'name',
      'default' => true,
      'width' => '10%',
    ),
);