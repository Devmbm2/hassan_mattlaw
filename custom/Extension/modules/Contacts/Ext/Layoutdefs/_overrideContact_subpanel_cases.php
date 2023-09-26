<?php
//auto-generated file DO NOT EDIT
$layout_defs['Contacts']['subpanel_setup']['cases']['override_subpanel_name'] = 'Contact_subpanel_cases';
$layout_defs['Contacts']['subpanel_setup']['cases']['override_sort_order'] = 'asc';
$layout_defs['Contacts']['subpanel_setup']['cases']['override_sort_by'] = 'name';
//$layout_defs['Contacts']['subpanel_setup']['cases']['order'] = 113;
$layout_defs["Contacts"]["subpanel_setup"]["cases"]["top_buttons"] = array(
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
);

$layout_defs["Contacts"]["subpanel_setup"]['cases']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);



?>