<?php
$subpanel_layout = array(
	'where' => " documents.hard_or_soft_doc = 'Hard_Documents' ",
    'list_fields'=> array(
		'object_image' => 
		array (
		'vname' => 'LBL_OBJECT_IMAGE',
		'widget_class' => 'SubPanelIcon',
		'width' => '2%',
		'image2' => 'attachment',
		'image2_url_field' => 
		array (
		  'id_field' => 'id',
		  'filename_field' => 'filename',
		),
		'attachment_image_only' => true,
		'default' => true,
		),
		'date_of_document_c' => 
		array (
		'type' => 'date',
		'default' => true,
		'vname' => 'LBL_DATE_OF_DOCUMENT',
		'width' => '10%',
		),
		'cases_documents_name' => 
		 array (
		'type' => 'relate',
		'source' => 'non-db',
		'vname' => 'LBL_CASES',
		'save' => true,
		'id_name' => 'case_id',
		'link' => 'documents_cases',
		'table' => 'cases',
		'module' => 'Cases',
		'rname' => 'name',
		// 'required' => true,
		),
		'document_name' => 
		array (
		'name' => 'document_name',
		'vname' => 'LBL_LIST_DOCUMENT_NAME',
		'widget_class' => 'SubPanelDetailViewLink',
		'width' => '20%',
		'default' => true,
		),
		'category_id' => 
		array (
		'name' => 'category_id',
		'vname' => 'LBL_LIST_CATEGORY',
		'width' => '20%',
		'default' => true,
		),
		'subcategory_id' => 
		array (
		'type' => 'enum',
		'vname' => 'LBL_SF_SUBCATEGORY',
		'width' => '10%',
		'default' => true,
		),
		'filename' => 
		array (
		'name' => 'filename',
		'vname' => 'LBL_LIST_VIEW_DOCUMENT',
		'width' => '20%',
		'module' => 'Documents',
		'sortable' => false,
		'displayParams' => 
		array (
		  'module' => 'Documents',
		),
		'default' => true,
		),
		// 'case_assigned_to_c' => 
		// array (
		// 'type' => 'relate',
		// 'default' => true,
		// 'studio' => 'visible',
		// 'vname' => 'LBL_CASE_ASSIGNED_TO',
		// 'id' => 'USER_ID_C',
		// 'link' => true,
		// 'width' => '10%',
		// 'widget_class' => 'SubPanelDetailViewLink',
		// 'target_module' => 'Users',
		// 'target_record_key' => 'user_id_c',
		// ),
		// 'done_c' => 
		// array (
		// 'type' => 'bool',
		// 'default' => true,
		// 'vname' => 'LBL_DONE',
		// 'width' => '10%',
		// ),
		'edit_button' => 
		array (
		'vname' => 'LBL_EDIT_BUTTON',
		'widget_class' => 'SubPanelEditButton',
		'module' => 'Documents',
		'width' => '5%',
		'default' => true,
		),
		'remove_button' => 
		array (
		'vname' => 'LBL_REMOVE',
		'widget_class' => 'SubPanelRemoveButton',
		'module' => 'Documents',
		'width' => '5%',
		'default' => true,
		),
		'document_revision_id' => 
		array (
		'name' => 'document_revision_id',
		'usage' => 'query_only',
		),
  ),
);