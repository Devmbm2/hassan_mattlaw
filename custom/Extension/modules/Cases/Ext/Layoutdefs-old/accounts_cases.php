<?php
 // created: 2017-06-16 20:36:27
$layout_defs["Cases"]["subpanel_setup"]['accounts'] = array (
  //'order' => 16,
  'module' => 'Accounts',
  'subpanel_name' => 'ForCases',
  'sort_order' => 'asc',
  'sort_by' => 'name',
  'title_key' => 'LBL_ACCOUNTS_SUBPANEL_TITLE',
  'get_subpanel_data' => 'accounts',
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
    2 =>
    array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  ),
);


$layout_defs["Cases"]["subpanel_setup"]['accounts']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);
