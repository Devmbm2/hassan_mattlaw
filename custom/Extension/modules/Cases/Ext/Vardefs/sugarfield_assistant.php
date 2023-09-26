<?php
$dictionary['Case']['fields']['default_assistant_lawyer_name'] = array(
	'required'  => false,
	'source'    => 'non-db',
	'name'      => 'default_assistant_lawyer_name',
	'vname'     => 'LBL_DEFAULT_ASSISTANT_NAME',
	'type'      => 'relate',
	'rname' => 'name',
	'id_name'   => 'default_assistant_lawyer_id',
	'table'     => 'users',
	'isnull'    => 'true',
	'module'    => 'Users',
	'ext2' => 'Users',
);
$dictionary['Case']['fields']['default_assistant_lawyer_id'] = array(
	'name'              => 'default_assistant_lawyer_id',
	'rname'             => 'id',
	'vname'             => 'LBL_DEFAULT_ASSISTANT_ID',
	'type'              => 'id',
	'table'             => 'users',
	'isnull'            => 'true',
	'module'            => 'Users',
	'dbType'            => 'id',
	'reportable'        => false,
	'massupdate'        => false,
	'duplicate_merge'   => 'disabled',
);