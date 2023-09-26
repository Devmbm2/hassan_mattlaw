<?php
// created: 2018-10-09 04:23:29
$subpanel_layout['list_fields'] = array (
  0 => 
  array (
    'name' => 'nothing',
    'widget_class' => 'SubPanelIcon',
    'module' => 'Tasks',
    'width' => '2%',
    'default' => true,
  ),
  'name' => 
  array (
    'name' => 'name',
    'vname' => 'LBL_LIST_SUBJECT',
    'module' => 'Tasks',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '30%',
    'default' => true,
  ),
  'status' => 
  array (
    'name' => 'status',
    'widget_class' => 'SubPanelActivitiesStatusField',
    'vname' => 'LBL_LIST_STATUS',
    'module' => 'Tasks',
    'width' => '15%',
    'default' => true,
  ),
  'date_start' => 
  array (
    'name' => 'date_start',
    'vname' => 'LBL_LIST_DUE_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'priority' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_PRIORITY',
    'width' => '10%',
    'default' => true,
  ),
  'time_spent_c' => 
  array (
    'type' => 'decimal',
    'default' => true,
    'vname' => 'LBL_TIME_SPENT',
    'width' => '10%',
  ),
  'team_c' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_TEAM',
    'id' => 'SECURITYGROUP_ID_C',
    'link' => true,
    'width' => '10%',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'SecurityGroups',
    'target_record_key' => 'securitygroup_id_c',
  ),
  'mreq_medb_requests_tasks_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MREQ_MEDB_REQUESTS_TASKS_1_FROM_MREQ_MEDB_REQUESTS_TITLE',
    'id' => 'MREQ_MEDB_REQUESTS_TASKS_1MREQ_MEDB_REQUESTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'MREQ_MEDB_Requests',
    'target_record_key' => 'mreq_medb_requests_tasks_1mreq_medb_requests_ida',
  ),
  'edit_button' => 
  array (
    'name' => 'nothing',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'Tasks',
    'width' => '2%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'name' => 'nothing',
    'widget_class' => 'SubPanelRemoveButton',
    'linked_field' => 'tasks',
    'module' => 'Tasks',
    'width' => '2%',
    'default' => true,
  ),
);
