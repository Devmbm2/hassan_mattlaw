<?php
// created: 2020-04-09 04:30:19
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'age' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_AGE',
    'width' => '10%',
    'default' => true,
  ),
  'relationship_to_main_client' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'vname' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
    'width' => '10%',
    'default' => true,
  ),
  'total_lops_liens' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_TOTAL_LOPS_LIENS',
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
  'comp_companions_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
    'id' => 'COMP_COMPANIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'comp_companions_casescases_ida',
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