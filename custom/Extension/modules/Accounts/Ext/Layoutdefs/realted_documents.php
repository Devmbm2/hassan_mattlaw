<?php 
 $layout_defs["Accounts"]["subpanel_setup"]['soft_documents'] = array (
    'order' => 18,
    'sort_by' => 'date_entered',
    'sort_order' => 'DESC',
    'module' => 'Documents',
    'subpanel_name' => 'soft_documents',
    'title_key' => 'LBL_SOFT_DOCUMENTS_SUB',
    'get_subpanel_data' => 'documents',
    // 'generate_select' => true,
     // 'function_parameters' => array(
     //     File where the above function is defined at
          // 'import_function_file' => 'custom/include/custom_utils.php',
          // ),
  
    'top_buttons' =>
    array (
       0 =>
      array (
        'widget_class' => 'SubPanelTopButtonQuickCreateSoftButtonTemplate',
      ),
      1 =>
      array (
        'widget_class' => 'SubPanelTopButtonQuickCreateSoftButton',
      ),
    2 =>array (
          'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
    ),
  
    ),
  );
  $layout_defs["Accounts"]["subpanel_setup"]['soft_documents']['searchdefs'] =
  array ( 'document_name' =>
          array (
              'name' => 'document_name',
              'default' => true,
              'width' => '10%',
          ),
  );