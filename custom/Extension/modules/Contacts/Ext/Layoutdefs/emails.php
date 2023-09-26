 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["Contacts"]["subpanel_setup"]['emails'] = array(
//	'order' => 10,
	'sort_order' => 'desc',
	'sort_by' => 'date_entered',
	'title_key' => 'Emails',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
	'module' => 'Activities',

	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
	),

	'collection_list' => array(
		'emails' => array(
                    'module' => 'Emails',
                    'subpanel_name' => 'ForContactEmail',
                    'get_subpanel_data' => 'function:get_emails_by_assign_or_linkss',
                    'function_parameters' => array('import_function_file' => 'custom/include/custom_utils.php', 'link' => 'cases'),
                    'generate_select' => true,
                ),
	),
);


$layout_defs["Contacts"]["subpanel_setup"]['emails']['searchdefs'] =
array ( 'name' =>
	  array (
		  'name' => 'name',
		  'default' => true,
		  'width' => '10%',
	  ),
);

