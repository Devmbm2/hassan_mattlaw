 <?php
   $layout_defs["Cases"]["subpanel_setup"]['activities'] = array(
            'sort_order' => 'asc',
            'sort_by' => 'date_due',
            'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_DUE',
            'type' => 'collection',
            'subpanel_name' => 'activities',
            'module' => 'Activities',
            'top_buttons' => array(
                array('widget_class' => 'SubPanelTopCreateTaskButton'),
				array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
            ),

            'collection_list' => array(
                'tasks' => array(
                    'module' => 'Tasks',
                    'subpanel_name' => 'ForActivitiesDue',
                    'get_subpanel_data' => 'tasks',
                ),
            )
        );


		$layout_defs["Cases"]["subpanel_setup"]['activities']['searchdefs'] =
		array ( 'name' =>
				array (
					'name' => 'name',
					'default' => true,
					'width' => '10%',
				),
		);




$layout_defs["Cases"]["subpanel_setup"]['activities_skipped'] = array(
	'sort_order' => 'asc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_SKIPPED',
	'type' => 'collection',
	'subpanel_name' => 'activities', 
	'module' => 'Activities',


	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
	),
	'collection_list' => array(
		'tasks' => array(
			'module' => 'Tasks',
			'subpanel_name' => 'ForActivitiesSkipped',
			'get_subpanel_data' => 'tasks',
		),

	),
);

$layout_defs["Cases"]["subpanel_setup"]['activities_skipped']['searchdefs'] =
array ( 'name' =>
		array (
			'name' => 'name',
			'default' => true,
			'width' => '10%',
		),
);




$layout_defs["Cases"]["subpanel_setup"]['activities_done'] = array(
	'sort_order' => 'desc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_DONE',
	'type' => 'collection',
	'subpanel_name' => 'activities', 
	'module' => 'Activities',
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
	),

	'collection_list' => array(
		'tasks' => array(
			'module' => 'Tasks',
			'subpanel_name' => 'ForActivitiesDone',
			'get_subpanel_data' => 'tasks',
		),

	),
);

$layout_defs["Cases"]["subpanel_setup"]['activities_done']['searchdefs'] =
array ( 'name' =>
		array (
			'name' => 'name',
			'default' => true,
			'width' => '10%',
		),
);





$layout_defs["Cases"]["subpanel_setup"]['activities_overdue'] = array(
	'sort_order' => 'desc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_OVERDUE',
	'type' => 'collection',
	'subpanel_name' => 'activities',
	'module' => 'Activities',
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
	),

	'collection_list' => array(
		'tasks' => array(
			'module' => 'Tasks',
			'subpanel_name' => 'ForActivitiesOverDue',
			'get_subpanel_data' => 'tasks',
		),

	),
);

$layout_defs["Cases"]["subpanel_setup"]['activities_overdue']['searchdefs'] =
array ( 'name' =>
		array (
			'name' => 'name',
			'default' => true,
			'width' => '10%',
		),
);

