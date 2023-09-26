<?php
 // created: 2016-12-23 14:45:48
$dictionary['Document']['fields']['document_notes_media'] = array(
	'name' => 'document_notes_media',
	'type' => 'link',
	'relationship' => 'document_notes_media',
	'source'=>'non-db',
	'vname'=>'LBL_DOCUMENT_NOTES_MEDIA'
	);

	// Relationship Definition
	$dictionary["Document"]["relationships"]['document_notes_media'] = array(
	'lhs_module'=> 'Documents',
	'lhs_table'=> 'documents',
	'lhs_key' => 'id', 
	'rhs_module'=> 'Notes',
	'rhs_table'=> 'notes',
	'rhs_key' => 'document_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>