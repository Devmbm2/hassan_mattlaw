<?php
$layout_defs["Contacts"]["subpanel_setup"]['history'] = array(
	// 'order' => 128,
	'sort_order' => 'desc',
	'sort_by' => 'date_entered',
	'title_key' => 'LBL_HISTORY_SUBPANEL_TITLE',
	'type' => 'collection',
	'subpanel_name' => 'history',   //this values is not associated with a physical file.
	'module' => 'History',

	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateNoteButton'),
		array('widget_class' => 'SubPanelTopScheduleCallButton'),
		array('widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels'),
	),

	'collection_list' => array(
		'notes' => array(
			'module' => 'Notes',
			'subpanel_name' => 'ForHistory',
			'get_subpanel_data' => 'notes',
		),
		'calls' => array(
			'module' => 'Calls',
			'subpanel_name' => 'ForHistory',
			'get_subpanel_data' => 'calls',
		),
		
	),
);

$layout_defs["Contacts"]["subpanel_setup"]['history']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);
