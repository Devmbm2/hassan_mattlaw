<?php
 
$layout_defs["Cases"]["subpanel_setup"]['cases_ht_damages'] = array (
  'order' => 1002,
  'module' => 'ht_Damages',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CASES_HT_DAMAGES_HT',
  'get_subpanel_data' => 'cases_ht_damages',
  'top_buttons' => array (
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

$layout_defs["Cases"]["subpanel_setup"]['cases_ht_damages']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);