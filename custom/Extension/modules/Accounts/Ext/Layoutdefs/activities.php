<?php
$layout_defs["Accounts"]["subpanel_setup"]['activities'] = array(
        'order' => 1,
        'sort_order' => 'desc',
        'sort_by' => 'date_start',
        'title_key' => 'LBL_ACTIVITIES_SUBPANEL_TITLE',
        'type' => 'collection',
        'subpanel_name' => 'activities',   //this values is not associated with a physical file.
        'module' => 'Activities',

        'top_buttons' => array(
                array('widget_class' => 'SubPanelTopCreateTaskButton'),
                array('widget_class' => 'SubPanelTopScheduleEventButton'),
        ),
	'collection_list' => array(
		'tasks' => array(
                    'module' => 'Tasks',
                    'subpanel_name' => 'ForActivities',
                    'get_subpanel_data' => 'tasks',
                ),
	)
);

?>
