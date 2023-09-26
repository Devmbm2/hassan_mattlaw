 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["Cases"]["subpanel_setup"]['get_case_workflows'] = array(
	// numeric order position of subpanel by default ( lowest number comes first )
    'order' => 20,
    'sort_by' => 'date_entered',
    'sort_order' => 'desc',
    'title_key' => 'Workflows',
    'subpanel_name' => 'ForCases',
    'module' => 'AOW_Processed',
    // Specify the custom function to call
    'get_subpanel_data' => 'function:get_case_workflows',
	'top_buttons' => 
	  array (
		0 => 
		array (
		  'widget_class' => 'SubPanelTopExecuteWorkflowButton',
		),
        1 =>
        array (
          'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
        ),
	  ),	
    // Set to true to indicate we are building a custom SQL query
    'generate_select' => true,             
    'function_parameters' => array(
        // File where the above function is defined at
        'import_function_file' => 'custom/include/custom_utils.php', 
        ), 
);
$layout_defs["Cases"]["subpanel_setup"]['get_case_workflows']['searchdefs'] =
array ( 'aow_workflow' =>
        array (
            'name' => 'aow_workflow',
            'default' => true,
            'width' => '10%',
        ),
);

