<?php
 // created: 2017-06-13 17:19:09
$layout_defs["Cases"]["subpanel_setup"]['cost_client_cost_cases'] = array (
  'order' => 2,
  'module' => 'COST_Client_Cost',
  'subpanel_name' => 'default',
  'sort_order' => 'desc',
  'sort_by' => 'date_entered',
  'title_key' => 'LBL_COST_CLIENT_COST_CASES_FROM_COST_CLIENT_COST_TITLE',
  'get_subpanel_data' => 'cost_client_cost_cases',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 =>array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
    //1 => 
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
);
$layout_defs["Cases"]["subpanel_setup"]['cost_client_cost_cases']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);