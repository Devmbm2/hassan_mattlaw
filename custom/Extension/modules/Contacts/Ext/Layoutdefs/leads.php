<?php
$layout_defs["Contacts"]["subpanel_setup"]["documents"]["top_buttons"] = array(
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

$layout_defs["Contacts"]["subpanel_setup"]['documents']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),
);
