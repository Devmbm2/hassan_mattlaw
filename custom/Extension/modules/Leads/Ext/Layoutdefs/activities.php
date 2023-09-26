<?php

//$layout_defs["Leads"]["subpanel_setup"]["activities"]["top_buttons"] = array(
//        array(
//		'widget_class' => 'SubPanelTopCreateTaskButton',
//               'widget_class' => 'SubPanelTopScheduleEvenyButton',
//              'widget_class' => 'SubPanelTopScheduleCallButton',
//        ),
//    );

$layout_defs["Leads"]["subpanel_setup"]['activities'] = array(
        'order' => 10,
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
