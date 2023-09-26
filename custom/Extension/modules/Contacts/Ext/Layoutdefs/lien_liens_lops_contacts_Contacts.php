<?php
 // created: 2017-09-18 04:07:10
$layout_defs["Contacts"]["subpanel_setup"]['lien_liens_lops_contacts'] = array (
 // 'order' => 14,
  'module' => 'LIEN_Liens_LOPs',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LIEN_LIENS_LOPS_CONTACTS_FROM_LIEN_LIENS_LOPS_TITLE',
  'get_subpanel_data' => 'lien_liens_lops_contacts',
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
    2 =>array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
),
   
  ),
);

$layout_defs["Contacts"]["subpanel_setup"]['lien_liens_lops_contacts']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);