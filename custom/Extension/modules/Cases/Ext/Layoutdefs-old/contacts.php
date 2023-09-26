<?php

$layout_defs['Cases']['subpanel_setup']['contacts']['sort_order'] = 'asc';
$layout_defs['Cases']['subpanel_setup']['contacts']['sort_by'] = 'name';
//$layout_defs['Cases']['subpanel_setup']['contacts']['order'] = 5;
$layout_defs['Cases']['subpanel_setup']['contacts']['top_buttons'] = array (
    0=>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
    1 =>
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    2 =>
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
);
$layout_defs["Cases"]["subpanel_setup"]['contacts']['searchdefs'] =
array ( 'first_name' =>
        array (
            'name' => 'first_name',
            'default' => true,
            'width' => '10%',
        ),
        'last_name' =>
        array (
            'name' => 'last_name',
            'default' => true,
            'width' => '10%',
        ),
);
