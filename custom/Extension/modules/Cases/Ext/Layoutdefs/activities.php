 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
/* $layout_defs["Cases"]["subpanel_setup"]['activities_due'] = array(
	'order' => 10,
	'sort_order' => 'desc',
	'sort_by' => 'due_date',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_DUE',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
	'module' => 'Activities',

	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateTaskButton'),
		
	),

	'collection_list' => array(
		'tasks' => array(
			'module' => 'Tasks',
			'subpanel_name' => 'ForActivitiesDue',
			'get_subpanel_data' => 'tasks',
		),
		
	),
); */

  $layout_defs["Cases"]["subpanel_setup"]['activities'] = array(
            'order' => 20,
            'sort_order' => 'asc',
            'sort_by' => 'date_due',
            'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_DUE',
            'type' => 'collection',
            'subpanel_name' => 'activities',   //this values is not associated with a physical file.
            'module' => 'Activities',

            'top_buttons' => array(
                array('widget_class' => 'SubPanelTopCreateTaskButton'),
                array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
               /*  array('widget_class' => 'SubPanelTopScheduleMeetingButton'),
                array('widget_class' => 'SubPanelTopScheduleCallButton'),
                array('widget_class' => 'SubPanelTopComposeEmailButton'), */
            ),

            'collection_list' => array(
               /*  'meetings' => array(
                    'module' => 'Meetings',
                    'subpanel_name' => 'ForActivities',
                    'get_subpanel_data' => 'meetings',
                ), */
                'tasks' => array(
                    'module' => 'Tasks',
                    'subpanel_name' => 'ForActivitiesDue',
                    'get_subpanel_data' => 'tasks',
                ),
             /*    'calls' => array(
                    'module' => 'Calls',
                    'subpanel_name' => 'ForActivities',
                    'get_subpanel_data' => 'calls',
                ), */
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
	'order' => 21,
	'sort_order' => 'asc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_SKIPPED',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
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
	'order' => 19,
	'sort_order' => 'desc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_DONE',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
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
	'order' => 19,
	'sort_order' => 'desc',
	'sort_by' => 'date_start',
	'title_key' => 'LBL_TASKS_CUSTOM_SUBPANEL_TITLE_OVERDUE',
	'type' => 'collection',
	'subpanel_name' => 'activities',   //this values is not associated with a physical file.
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

