<?php
 // created: 2017-06-19 11:54:07
$layout_defs["Cases"]["subpanel_setup"]['neg_negotiations_cases'] = array (
  //'order' => 14,
  'sort_by' => 'date_of_negotiation_c',
  'sort_order' => 'desc',
  'module' => 'NEG_Negotiations',
  'subpanel_name' => 'default',
  'title_key' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_NEG_NEGOTIATIONS_TITLE',
  'get_subpanel_data' => 'neg_negotiations_cases',
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

$layout_defs["Cases"]["subpanel_setup"]['neg_negotiations_cases']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),

);
