<?php
$subpanel_layout = array(
	'top_buttons' => array(
       array('widget_class' => 'SubPanelTopCreateButton'),
	),
	'where' => " disc_discovery.done = '1' ",
	'list_fields'=> array(
	  'date_served' => 
	  array (
		'type' => 'date',
		'vname' => 'LBL_DATE_SERVED',
		'width' => '10%',
		'default' => true,
	  ),
	  'document_name' => 
	  array (
		'name' => 'document_name',
		'vname' => 'LBL_LIST_DOCUMENT_NAME',
		'widget_class' => 'SubPanelDetailViewLink',
		'width' => '10%',
		'default' => true,
	  ),
	  'type' => 
	  array (
		'type' => 'enum',
		'studio' => 'visible',
		'vname' => 'LBL_TYPE',
		'width' => '10%',
		'default' => true,
	  ),
	  'sent_received' => 
	  array (
		'type' => 'enum',
		'studio' => 'visible',
		'vname' => 'LBL_SENT_RECEIVED',
		'width' => '10%',
		'default' => true,
	  ),
	  'parent_name' => 
	  array (
		'type' => 'parent',
		'studio' => 'visible',
		'vname' => 'LBL_FLEX_RELATE',
		'link' => true,
		'sortable' => false,
		'ACLTag' => 'PARENT',
		'dynamic_module' => 'PARENT_TYPE',
		'id' => 'PARENT_ID',
		'related_fields' => 
		array (
		  0 => 'parent_id',
		  1 => 'parent_type',
		),
		'width' => '10%',
		'default' => true,
		'widget_class' => 'SubPanelDetailViewLink',
		'target_module' => NULL,
		'target_record_key' => 'parent_id',
	  ),
	  'uploadfile' => 
	  array (
		'name' => 'uploadfile',
		'vname' => 'LBL_LIST_VIEW_DOCUMENT',
		'width' => '20%',
		'module' => 'DISC_Discovery',
		'sortable' => false,
		'displayParams' => 
		array (
		  'module' => 'DISC_Discovery',
		),
		'default' => true,
	  ),
	  'done' => 
	  array (
		'type' => 'bool',
		'default' => true,
		'vname' => 'LBL_DONE',
		'width' => '10%',
	  ),
	  'authors_name_discovery_c' => 
	  array (
		'type' => 'varchar',
		'default' => true,
		'vname' => 'LBL_AUTHORS_NAME_DISCOVERY',
		'width' => '10%',
	  ),
	  'edit_button' => 
	  array (
		'vname' => 'LBL_EDIT_BUTTON',
		'widget_class' => 'SubPanelEditButton',
		'module' => 'DISC_Discovery',
		'width' => '5%',
		'default' => true,
	  ),
	  'remove_button' => 
	  array (
		'width' => '5%',
		'vname' => 'LBL_REMOVE',
		'default' => true,
		'widget_class' => 'SubPanelRemoveButton',
	  ),
  ),
);