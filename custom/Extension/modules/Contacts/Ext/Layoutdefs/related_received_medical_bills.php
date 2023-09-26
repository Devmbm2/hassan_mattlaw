<?php

$layout_defs["Contacts"]["subpanel_setup"]['related_received_medical_bills'] = array (
 // 'order' => 132,
  'module' => 'MDOC_Incoming_Bills',
  'subpanel_name' => 'Contact_subpanel_contact_mdoc_incoming_bills',
  'sort_order' => 'desc',
  'sort_by' => 'date_entered',
  'title_key' => 'LBL_RELATEDRECEIVEDMEDICALBILLS',
  'get_subpanel_data' => 'function:getRelatedReceivedMedicalBills',
  'generate_select' => true,             
  'get_distinct_data' => true,             
  'function_parameters' => array(
     'import_function_file' => 'custom/include/custom_utils.php', 
     'contact_id' => $this->_focus->id, 
  ),
  'top_buttons' => 
  array (
    2 =>array (
      'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
),
   
  ),
);

$layout_defs["Contacts"]["subpanel_setup"]['related_received_medical_bills']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);