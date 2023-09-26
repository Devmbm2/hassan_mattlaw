<?php
$dictionary['DISC_Discovery']['fields']['user_name'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'user_name',
    'vname'     => 'LBL_CONTACT',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'user_id',
    //'join_name' => 'a',
    /* 'link'      => 'assigned_user_link', */
    'table'     => 'users',
    'isnull'    => 'true',
    'module'    => 'Users',
    );
$dictionary['DISC_Discovery']['fields']['user_id'] = array(
    'name'              => 'user_id',
    'rname'             => 'id',
    'vname'             => 'LBL_CONTACT_ID',
    'type'              => 'id',
    'table'             => 'users',
    'isnull'            => 'true',
    'module'            => 'Users',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
	'source'    => 'non-db',
    );

