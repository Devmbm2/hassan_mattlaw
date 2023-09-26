 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["Cases"]["subpanel_setup"]['emails'] = array(
	//'order' => 10,
	'sort_order' => 'desc',
	'sort_by' => 'date_entered',
	'title_key' => 'Emails',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
	'module' => 'Activities',

	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
		array (
			'widget_class' => 'SubPanelTopButtonQuickCreate',
		  ),
	),

	'collection_list' => array(
		'emails' => array(
                    'module' => 'Emails',
                    'subpanel_name' => 'ForUnlinkedEmailHistory',
                    'get_subpanel_data' => 'function:get_emails_by_assign_or_link',
                    'function_parameters' => array('import_function_file' => 'include/utils.php', 'link' => 'contacts'),
                    'generate_select' => true,
                ),
	),
);

$layout_defs["Cases"]["subpanel_setup"]['emails']['searchdefs'] =
array ( 'document_name' =>
        array (
            'name' => 'document_name',
            'default' => true,
            'width' => '10%',
        ),

);

