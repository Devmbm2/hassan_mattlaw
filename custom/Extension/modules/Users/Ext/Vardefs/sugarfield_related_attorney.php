<?php
$dictionary['User']['fields']['user_assistant'] = array(
	'name' => 'user_assistant',
	'type' => 'link',
	'relationship' => 'user_assistant',
	'source'=>'non-db',
	'link_type' => 'one',
    'side' => 'right',
	'vname'=>'LBL_USER_ASSISTANT'
);

$dictionary['User']['fields']['direct_reports'] = array (
	  'name' => 'direct_reports',
	  'type' => 'link',
	  'relationship' => 'user_assistant',
	  'source' => 'non-db',
	  'vname' => 'LBL_USER_ASSISTANT',
    );
	
// Relationship Definition
$dictionary["User"]["relationships"]['user_assistant'] = array(
	'lhs_module'=> 'Users',
	'lhs_table'=> 'users',
	'lhs_key' => 'id', 
	'rhs_module'=> 'Users',
	'rhs_table'=> 'users',
	'rhs_key' => 'assistant_id',
	'relationship_type'=>'one-to-many',
);

$dictionary['User']['fields']['assistant_name'] = array(
	'required'  => false,
	'source'    => 'non-db',
	'name'      => 'assistant_name',
	'vname'     => 'LBL_ASSISTANT_NAME',
	'type'      => 'relate',
	'rname'     => 'name',
	'id_name'   => 'assistant_id',
	'link'      => 'user_assistants',
	'table'     => 'users',
	'isnull'    => 'true',
	'module'    => 'Users',
);
$dictionary['User']['fields']['assistant_id'] = array(
	'name'              => 'assistant_id',
	'rname'             => 'id',
	'vname'             => 'LBL_ASSISTANT_ID',
	'type'              => 'id',
	'table'             => 'users',
	'isnull'            => 'true',
	'module'            => 'Users',

	'dbType'            => 'id',
	'reportable'        => false,
	'massupdate'        => false,
	'duplicate_merge'   => 'disabled',
);

// Default Assistant

$dictionary['User']['fields']['default_assistant_name'] = array(
	'required'  => false,
	'source'    => 'non-db',
	'name'      => 'default_assistant_name',
	'vname'     => 'LBL_DEFAULT_ASSISTANT_NAME',
	'type'      => 'relate',
	'rname'     => 'name',
	'link'      => 'direct_reports',
	'id_name'   => 'default_assistant_id',
	'table'     => 'users',
	'isnull'    => 'true',
	'module'    => 'Users',
);
$dictionary['User']['fields']['default_assistant_id'] = array(
	'name'              => 'default_assistant_id',
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
