<?php
$layout_defs['Documents']['subpanel_setup']['leads'] = array(
	'order' => 50,
	'module' => 'Leads',
	'subpanel_name' => 'default',
	'sort_order' => 'asc',
	'sort_by' => 'id',
	'title_key' => 'LBL_LEADS_SUBPANEL_TITLE',
	'get_subpanel_data' => 'leads',
	'top_buttons' =>
	array(
		0 =>
			array(
				'widget_class' => 'SubPanelTopButtonQuickCreate',
			),
		1 =>
			array(
				'widget_class' => 'SubPanelTopSelectButton',
			),
	),
);
?>