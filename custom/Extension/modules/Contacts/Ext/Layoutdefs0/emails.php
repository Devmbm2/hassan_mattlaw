 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["Contacts"]["subpanel_setup"]['emails'] = array(
	'order' => 10,
	'sort_order' => 'desc',
	'sort_by' => 'date_entered',
	'title_key' => 'Emails',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
	'module' => 'Activities',

	//'top_buttons' => array(
	//	array('widget_class' => 'SubPanelTopArchiveEmailButton'),
	//),

	'collection_list' => array(
		'emails' => array(
                    'module' => 'Emails',
                    'subpanel_name' => 'ForUnlinkedEmailHistory',
                    'get_subpanel_data' => 'function:get_emails_by_assign_or_link',
                    'function_parameters' => array('import_function_file' => 'include/utils.php', 'link' => 'cases'),
                    'generate_select' => true,
                ),
	),
);


