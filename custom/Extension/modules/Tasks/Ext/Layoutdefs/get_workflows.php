 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["Tasks"]["subpanel_setup"]['get_case_workflows'] = array(
	// numeric order position of subpanel by default ( lowest number comes first )
    'order' => 20,
    'sort_by' => 'date_entered',
    'sort_order' => 'desc',
    'title_key' => 'Workflows',
    'subpanel_name' => 'ForCases',
    'module' => 'AOW_Processed',
    // Specify the custom function to call
    'get_subpanel_data' => 'function:get_task_workflows',
    // Set to true to indicate we are building a custom SQL query
    'generate_select' => true,             
    'function_parameters' => array(
        // File where the above function is defined at
        'import_function_file' => 'custom/include/custom_utils.php', 
        ), 
);


