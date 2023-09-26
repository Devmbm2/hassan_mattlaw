<?php
 // created: 2017-07-19 13:33:18
  $dictionary['FP_events']['fields']['parent_name'] =
    array (
      'name' => 'parent_name',
      'parent_type' => 'location_type_dom',
      'type_name' => 'parent_type',
      'id_name' => 'parent_id',
      'vname' => 'LBL_LOCATION',
      'type' => 'parent',
      'source' => 'non-db',
      'options' => 'location_type_dom',
    );
    $dictionary['FP_events']['fields']['parent_type'] =
    array (
      'name' => 'parent_type',
      'vname' => 'LBL_PARENT_TYPE',
      'type' => 'parent_type',
      'dbType' => 'varchar',
      'group' => 'parent_name',
      'options' => 'location_type_dom',
      'len' => '255',
      'comment' => 'Sugar module the Note is associated with',
    );
    $dictionary['FP_events']['fields']['parent_id'] =
    array (
      'name' => 'parent_id',
      'vname' => 'LBL_parent_id',
      'type' => 'id',
      'required' => false,
      'reportable' => true,
      'comment' => 'The ID of the Sugar item specified in parent_type',
    );