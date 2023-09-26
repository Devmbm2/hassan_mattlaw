<?php
// created: 2019-11-10 00:12:55
$subpanel_layout['list_fields'] = array (
  'date_entered' => 
  array (
    'type' => 'datetime',
    'vname' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'vname' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => NULL,
    'target_record_key' => NULL,
  ),
  'relationship_to_main_client' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
    'width' => '10%',
    'default' => true,
  ),
  'total_medical_bills' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_TOTAL_MEDICAL_BILLS',
    'width' => '10%',
    'default' => true,
  ),
  'age' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_AGE',
    'width' => '10%',
    'default' => true,
  ),
  'companion' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contact_id_c',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'COMP_Companions',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'COMP_Companions',
    'width' => '5%',
    'default' => true,
  ),
);