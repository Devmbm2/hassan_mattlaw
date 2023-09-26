<?php

$dictionary['FP_events']['fields']['related_event_name'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'related_event_name',
    'vname'     => 'LBL_RELATED_EVENT_NAME',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'related_event_id',
    'link'      => 'contact_document',
    'table'     => 'fp_events',
    'isnull'    => 'true',
    'module'    => 'FP_events',
    );
$dictionary['FP_events']['fields']['related_event_id'] = array(
    'name'              => 'related_event_id',
    'rname'             => 'id',
    'vname'             => 'LBL_RELATED_EVENT_ID',
    'type'              => 'id',
    'table'             => 'fp_events',
    'isnull'            => 'true',
    'module'            => 'FP_events',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
    );