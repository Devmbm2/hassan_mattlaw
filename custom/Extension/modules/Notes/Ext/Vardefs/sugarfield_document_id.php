<?php
$dictionary['Note']['fields']['document_name'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'document_name',
    'vname'     => 'LBL_DOCUMENT_NAME',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'document_id',
    'join_name' => 'document_notes_media',
    'link'      => 'document_notes_media',
    'table'     => 'documents',
    'isnull'    => 'true',
    'module'    => 'Documents',
    );
$dictionary['Note']['fields']['document_id'] = array(
    'name'              => 'document_id',
    'rname'             => 'id',
    'vname'             => 'LBL_DOCUMENT_ID',
    'type'              => 'id',
    'table'             => 'documents',
    'isnull'            => 'true',
    'module'            => 'Documents',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
    );
	
	$dictionary['Note']['fields']['document_notes_media'] = array(
	'name' => 'document_notes_media',
	'type' => 'link',
	'relationship' => 'document_notes_media',
	'source'=>'non-db',
	'vname'=>'LBL_DOCUMENT_NOTES_MEDIA'
	);

