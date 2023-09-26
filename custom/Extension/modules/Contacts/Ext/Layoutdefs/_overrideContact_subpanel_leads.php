<?php
//auto-generated file DO NOT EDIT
$layout_defs['Contacts']['subpanel_setup']['leads']['override_subpanel_name'] = 'Contact_subpanel_leads';
//$layout_defs['Contacts']['subpanel_setup']['leads']['override_order'] = 1;
$layout_defs["Contacts"]["subpanel_setup"]["leads"]["top_buttons"] = array(
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

$layout_defs["Contacts"]["subpanel_setup"]['leads']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);






?>