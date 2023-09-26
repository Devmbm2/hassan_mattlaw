<?php
 // created: 2017-08-28 23:40:08
$layout_defs["Cases"]["subpanel_setup"]['plea_pleadings_cases'] = array (
  //'order' => 17,
  'sort_oder' => 'desc',
  'sort_by' => 'date_filed_c',
  'module' => 'PLEA_Pleadings',
  'subpanel_name' => 'default',
  'sort_order' => 'DESC',
  'title_key' => 'LBL_PLEA_PLEADINGS_CASES_FROM_PLEA_PLEADINGS_TITLE',
  'get_subpanel_data' => 'plea_pleadings_cases',
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    //1 =>
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
    1 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);

$layout_defs["Cases"]["subpanel_setup"]['plea_pleadings_cases']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
