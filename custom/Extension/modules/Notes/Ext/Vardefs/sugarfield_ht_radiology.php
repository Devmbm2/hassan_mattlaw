<?php
$dictionary['Note']['fields']['ht_radiology_name'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'ht_radiology_name',
    'vname'     => 'LBL_CONTACT',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'ht_radiology_id',
    'link'      => 'notes_ht_radiology',
    'table'     => 'ht_radiology',
    'isnull'    => 'true',
    'module'    => 'ht_radiology',
    );
$dictionary['Note']['fields']['ht_radiology_id'] = array(
    'name'              => 'ht_radiology_id',
    'rname'             => 'id',
    'vname'             => 'LBL_HT_RADIOLOGY_ID',
    'type'              => 'id',
    'table'             => 'ht_radiology',
    'isnull'            => 'true',
    'module'            => 'ht_radiology',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
    );

	$dictionary['Note']['fields']['notes_ht_radiology'] = array(
		'name' => 'notes_ht_radiology',
		'type' => 'link',
		'relationship' => 'notes_ht_radiology',
		'source'=>'non-db',
		'vname'=>'LBL_NOTES_HT_RADIOLOGY'
	);
