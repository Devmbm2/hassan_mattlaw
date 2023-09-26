<?php
// created: 2019-12-05 14:42:30
$subpanel_layout['list_fields'] = array (
  // 'date_entered' => 
  // array (
  //   'type' => 'datetime',
  //   'vname' => 'LBL_DATE_ENTERED',
  //   'width' => '10%',
  //   'default' => true,
    
  // ),
  'hd_reviewed_date' => 
  array (
    'type' => 'date',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    
  ),
  'date_filed_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'vname' => 'LBL_DATE_FILED',
    'width' => '10%',
  ),
  'document_name' => 
  array (
    'width' => '40%',
    'vname' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
    'default' => true,
  ),
/*   'filename' => 
  array (
    'name' => 'filename',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '20%',
    'default' => true,
    'link' => true,
    'module' => 'PLEA_Pleadings',
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'PLEA_Pleadings',
    ),
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'PLEA_Pleadings',
    'target_record_key' => NULL,
  ), */
   'uploadfile' => 
  array (
    'type' => 'file',
    'vname' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'PLEA_Pleadings',
    ),
  ),
  'outgoing_document' => 
  array (
    'type' => 'bool',
    'default' => true,
    'vname' => 'LBL_OUTGOING_DOCUMENT',
    'width' => '10%',
  ),
  'incoming_or_outgoing' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_INCOMING_OR_OUTGOING',
    'width' => '10%',
    'default' => true,
  ),
  'author_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_AUTHOR',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'PLEA_Pleadings',
    'width' => '5%',
    'default' => true,
  ),
);